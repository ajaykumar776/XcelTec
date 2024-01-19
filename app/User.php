<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $appends = ['full_name'];
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'phone', 'map_details'];
    protected $hidden = ['password'];

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
        return self::all();
    }

    public static function getUserByEmailId($email)
    {
        return self::where('email', $email)->first();
    }

    public static function verifyEmailPass($email, $incoming_pass)
    {
        if ($email == "admin@gmail.com") {
            $admin = DB::table('admins')
                ->select('email', 'password')
                ->where('email', 'admin@gmail.com')
                ->first();

            return $admin && Hash::check($incoming_pass, $admin->password);
        } else {
            $user = self::where('email', $email)->first();
            return $user && Hash::check($incoming_pass, $user->password);
        }
    }

    public static function updateUser($id, $data)
    {
        $user = self::find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }

        return null;
    }

    public function setFullNameAttribute()
    {
        $this->attributes['full_name'] = $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }
}
