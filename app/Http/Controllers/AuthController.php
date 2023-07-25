<?php

namespace App\Http\Controllers;

use App\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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
                    $token = Str::random(200);
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

    public function APILogin(Request $request)
    {
        $email = $request->input('email');
        $pass = $request->input('pass');

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'pass' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['message' => $errors->first()], 422);
        }

        $check = UserModel::verifyEmailPass($email, $pass);
        if (!$check) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        if (Auth::attempt(['email' => $email, 'password' => $pass])) {
            $user = Auth::user();
            $auth_type = $user->user_type;
            $token = Str::random(200);
            UserModel::where('email', $email)->update(['tokens' => $token]);
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user_type' => $auth_type,
            ], 200);
        }

        return response()->json(['message' => 'Authentication failed. Please check your credentials.'], 401);
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
        $id = Auth::user()->id;
        $user = UserModel::find($id);
        $user->update(['tokens' => '']);
        $request->session()->forget('token');
        Auth::logout();
        $request->session()->forget('token');
        return redirect()->route('login');
    }
}
