<?php

namespace App\Http\Controllers;

use App\Source;
use App\Technology;
use Illuminate\Foundation\Auth\User;

class ReportController extends Controller
{
    public function technologyReport()
    {
        $technologyReport = Technology::withCount('users')->get();
        return view('admin/reports.technology', compact('technologyReport'));
    }

    public function registrationReport()
    {
        $registrationReport = Source::withCount('users')->get();
        return view('admin/reports.registration', compact(['registrationReport']));
    }
    public function mapReport()
    {
        $users = User::select('first_name', 'last_name', 'phone', 'email', 'map_details')
            ->whereNotNull('map_details')
            ->get();
        return view('admin/reports.map', compact('users'));
    }
}
