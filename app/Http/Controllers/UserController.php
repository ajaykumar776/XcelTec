<?php

namespace App\Http\Controllers;

use App\User;
use App\UserSource;
use App\Helpers\Common;
use Illuminate\Http\Request;
use App\UserTechnology;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->with('sources')->get();
        return view('admin/userlist', ['lists' => $users]);
    }

    public function UserDashboard()
    {
        if (session('user_type') == 'user') {
            return view('users/dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function create()
    {
        $sources = Common::getAllSources();
        if ($allowed = true) {
            $title = 'User-Register';
            $col_pass = true;
            $col_source = true;
            $col_technology = false;
            return view('users.register', compact('title', 'col_pass', 'col_source', 'col_technology', 'sources'));
        } else {
            return view('error');
        }
    }

    public function edit($id)
    {
        $title = 'Edit';
        $sources = Common::getAllSources();
        $technology = Common::getAllTechnology();
        $col_pass = false;
        $col_source = false;
        $col_technology = true;
        $data = User::with('technologies')->find($id);
        return view('users.register', compact('data', 'title', 'col_pass', 'col_source', 'col_technology', 'technology'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user_id = $request->user_id;

            if ($user_id) {
                $data = [
                    'phone' => $request->phone,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'map_details' => $request->map_details,
                ];

                $user = User::find($user_id);
                $updated = $user->update($data);

                if ($updated) {
                    $count = UserTechnology::all();

                    if (count($count) > 0) {
                        UserTechnology::where('user_id', $user_id)->delete();
                    }

                    $technology = $request->technology;
                    $tech = [];

                    foreach ($technology as $technologyId) {
                        $tech[] = [
                            'user_id' => $user_id,
                            'technology_id' => $technologyId,
                        ];
                    }

                    UserTechnology::insert($tech);
                }
            } else {
                $validatedData = $request->validate([
                    'phone' => 'required|string|max:10|unique:users,phone',
                    'first_name' => 'required|string|max:30',
                    'last_name' => 'required|string|max:30',
                    'email' => 'required|string|email|max:255|unique:users,email',
                    'password' => 'required|string|min:6|max:10',
                ]);

                $validatedData['password'] = bcrypt($validatedData['password']);
                $user = User::create($validatedData);
                $user_id = $user->id;

                $sources = $request->sources;
                $data = [];

                foreach ($sources as $sourceId) {
                    $data[] = [
                        'user_id' => $user_id,
                        'source_id' => $sourceId,
                    ];
                }

                UserSource::insert($data);
            }

            DB::commit();
            return redirect('/users')->with('success', 'User created/updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect('/users')->with('error', 'An error occurred. Please try again.');
        }
    }
}
