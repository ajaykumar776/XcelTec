<?php

namespace App\Http\Controllers;

use App\Hereabout;
use App\Source;
use App\Technology;

class ReportController extends Controller
{
    public function technologyReport()
    {
        $technologyReport = Technology::withCount('users')->get();
        return view('reports.technology', compact('technologyReport'));
    }

    public function registrationReport()
    {
        $registrationReport = Source::withCount('users')->get();
        return view('reports.registration', compact(['registrationReport']));
    }
}
