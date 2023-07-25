<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModel extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'user_type', 'email_verified', 'otp_verified', 'tokens', 'otp',
        'country_id', 'state_id', 'city_id'
    ];

    protected $hidden = [
        'password',
    ];

    // Custom function to get all users
    public static function individuals()
    {
        return UserModel::all();
    }
    public static function verifyEmailPass($email, $incoming_pass)
    {
        $email = UserModel::where('email', $email)->First();
        if ($email) {
            $password = $email->password;
            $password_verification = Hash::check($incoming_pass, $password);
            return $password_verification ? true : false;
        } else {
            return false;
        }
    }
    public static function EmailExist($email)
    {
        $email = UserModel::where('email', $email)->First();
        if ($email) {
            return true;
        } else {
            return false;
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
