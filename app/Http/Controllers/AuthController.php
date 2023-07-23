<?php

namespace App\Http\Controllers;

use App\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validation rules for registration
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email_otp = rand(100000, 999999);
        $mobile_otp = rand(100000, 999999);

        // Send the OTP to the user's email for verification
        $this->sendOtpEmail($request->email, $email_otp);
        $this->sendOtpSms($request->phone, $mobile_otp);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function loginSave(Request $request)
    {
        $email = $request->input('email');
        $pass = $request->input('pass');

        if ($email && $pass) {
            $check = UserModel::verifyEmailPass($email, $pass);
            if (!$check) {
                $errors = [
                    'email' => 'Please Enter Valid Email',
                    'pass' => 'Please Enter Valid Password',
                ];
                return view('login')->withErrors($errors);
            } else {
                if (Auth::attempt(['email' => $email, 'password' => $pass])) {
                    $user = Auth::user();
                    $auth_type = $user->user_type;
                    $token = Str::random(20);
                    UserModel::where('email', $email)->update(['tokens' => $token]);
                    $request->session()->put('token', $token);
                    $request->session()->put('user_type', $auth_type);
                    return redirect()->route('dashboard');
                } else {
                    $errors = [
                        'email' => 'Authentication failed. Please check your credentials.',
                    ];
                    return view('login')->withErrors($errors);
                }
            }
        } else {
            $errors = [
                'email' => 'Email is required',
                'pass' => 'Password is required',
            ];
            return view('login')->withErrors($errors);
        }
    }


    public function Login(Request $request)
    {
        $tokens = $request->session()->get('token');
        if ($tokens) {
            return redirect()->route('dashboard');
        } else {
            return view('login');
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $email = $user->email;
        // UserModel::where('email', $email)->update(['tokens' => '']);
        $request->session()->forget('token');
        Auth::logout();
        return redirect()->route('login');
    }
}
