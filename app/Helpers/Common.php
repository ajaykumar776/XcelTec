<?php

namespace App\Helpers;

use App\Source;
use App\Technology;

class Common
{
    public static function getAllSources()
    {
        return Source::all();
    }
    public static function getAllTechnology()
    {
        return Technology::all();
    }
}
