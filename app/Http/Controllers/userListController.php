<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\UserModel;

class userListController extends Controller
{
    // Get all users
    public function index()
    {
        $users = UserModel::all();
        return view('users/userlist', ['lists' => $users]);
    }

    // Load the create page
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        // echo json_encode($request);
        // die;
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // Add other validation rules for your user fields
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['user_type'] = 'User'; // Assuming the user type is 'User' for newly created users

        // Save the new user in the database
        $user = User::create($validatedData);

        // Redirect to the user list page or wherever you want after successful user creation
        return redirect('/users')->with('success', 'User created successfully!');
    }
}
