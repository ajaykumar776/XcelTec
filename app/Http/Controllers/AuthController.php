<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginSave(Request $request)
    {
        $email = $request->input('email');
        $pass = $request->input('pass');

        if ($email && $pass) {
            $check = User::verifyEmailPass($email, $pass);
            if (!$check) {
                $errors = [
                    'email' => 'Please Enter Valid Email',
                    'pass' => 'Please Enter Valid Password',
                ];
                return view('auth/login')->withErrors($errors);
            } else {
                $token = Str::random(200);
                $request->session()->put('token', $token);
                if ($email != "admin@gmail.com") {
                    $user = User::getUserByEmailId($email);
                    $request->session()->put('first_name', $user->first_name);
                    $request->session()->put('last_name', $user->last_name);
                    $request->session()->put('user_type', "user");
                    $request->session()->put('user_id', $user->id);
                    return redirect()->route('user_dashboard');
                } else {
                    $request->session()->put('user_type', "admin");
                    return redirect()->route('dashboard');
                }
            }
        } else {
            $errors = [
                'email' => 'Email is required',
                'pass' => 'Password is required',
            ];
            return view('auth/login')->withErrors($errors);
        }
    }

    public function Login(Request $request)
    {
        $tokens = $request->session()->get('token');
        if ($tokens) {
            return redirect()->route('dashboard');
        } else {
            return view('auth/login');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
