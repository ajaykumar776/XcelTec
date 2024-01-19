<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSource extends Model
{
    protected $table = 'user_sources';
    protected $fillable = ['user_id', 'source_id'];
}
