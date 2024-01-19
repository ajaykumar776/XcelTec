<?php

namespace App;

use App\Hereabout;
use App\Technology;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone', 'map_details'
    ];
    protected $hidden = [
        'password',
    ];

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'user_technologies');
    }
    public function sources()
    {
        return $this->belongsToMany(Source::class, 'user_sources', 'user_id', 'source_id');
    }

    public static function getAllUsers()
    {
        return User::all();
    }
    public static function getUserByEmailId($email)
    {
        return User::where('email', $email)->first();
    }
    public static function verifyEmailPass($email, $incoming_pass)
    {
        if ($email == "admin@gmail.com") {
            $results = DB::table('admins')
                ->select('email', 'password',)
                ->where('email', 'admin@gmail.com')
                ->get()[0];
            if ($results) {
                $password = $results->password;
                $password_verification = Hash::check($incoming_pass, $password);
                return $password_verification ? true : false;
            }
        } else {
            $email = User::where('email', $email)->First();
            if ($email) {
                $password = $email->password;
                $password_verification = Hash::check($incoming_pass, $password);
                return $password_verification ? true : false;
            } else {
                return false;
            }
        }
    }
    // Custom function to update a user
    public static function updateUser($id, $data)
    {
        $user = self::find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }

        return null;
    }

    // Custom function to delete a user
    public static function deleteUser($id)
    {
        $user = self::find($id);

        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }
}
