<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTechnology extends Model
{
    protected $table = 'user_technologies';
    protected $fillable = ['user_id', 'technology_id'];
}
