<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = 'sources';
    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_sources'
        );
    }
}
