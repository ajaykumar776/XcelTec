<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\UserModel;
use App\Mail\OTPMail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userListController extends Controller
{
    // Get all users
    public function index()
    {
        $oldusers = UserModel::all();
        foreach ($oldusers as $user) {
            if (!$user['otp_verified'] && $user['id'] != 3) {
                $this->destroy($user['id']);
            }
        }
        $users = UserModel::all();
        return view('users/userlist', ['lists' => $users]);
    }

    // Load the create page
    public function create()
    {

        $allowed = (Auth::user()->user_type == 'Admin') ? true : false;
        if ($allowed) {
            $title = 'Add';
            $col_pass = true;
            return view('users.register', compact('title', 'col_pass'));
        } else {
            return view('error');
        }
    }


    public function edit($id)
    {

        $allowed = (Auth::user()->user_type == 'Admin') ? true : false;
        if ($allowed) {
            $data = UserModel::find($id);
            $title = 'Edit';
            $col_pass = false;
            return view('users.register', compact('data', 'title', 'col_pass'));
        } else {
            return view('error');
        }
    }

    public function store(Request $request)
    {
        $user_id = $request->user_id;
        if ($user_id) {
            $validatedData = $request->validate([
                'phone' => 'required|string|max:10|unique:users,phone,' . $user_id,
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user_id,
                'user_type' => 'required',
            ]);
        } else {
            $validatedData = $request->validate([
                'phone' => 'required|string|max:10|unique:users,phone,' . $user_id,
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user_id,
                'password' => 'required|string|min:6|max:10',
                'user_type' => 'required',
            ]);
        }

        if ($user_id) {
            $user = UserModel::find($user_id);
            if ($user) {
                $user->update($validatedData);
            }
        } else {
            $validatedData['password'] = bcrypt($validatedData['password']);
            $validatedData['user_type'] = 'User'; // Assuming the user type is 'User' for newly created users
            $otp = mt_rand(100000, 999999);
            $validatedData['otp'] = $otp;
            $user = UserModel::create($validatedData);
            $request->session()->put('otp', $otp);
            return redirect('/user/otp/verification');
        }
        // Redirect to the user list page or wherever you want after successful user creation/update
        return redirect('/users')->with('success', 'User created/updated successfully!');
    }

    public function destroy($id)
    {
        $user_id  = Auth::user()->id;
        if ($user_id == $id) {
            return response()->json(['error' => 'User Cannot Delete yourSelf']);
        }
        $user = UserModel::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    public function OtpPage(Request $request)
    {

        $otp  = $request->session()->get('otp');
        return view('emails/otp', compact('otp'));
    }

    public function OtpVerification(Request $request)
    {
        $validatedData = $request->validate([
            'otp' => 'required|string|min:6|max:6',
        ]);
        $otp = $request->otp;
        $user = UserModel::where('otp', $otp)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP']);
        } else {
            $user->update(['otp_verified' => true]);
            return redirect()->back()->withErrors(['verified' => '! Successfully Verified']);
        }
    }
}
