<?php

namespace App\Http\Controllers;

use App\Technology;

use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::all();
        return view('admin/technologies.index', compact('technologies'));
    }

    public function create()
    {
        return view('admin/technologies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:technologies',
        ]);

        Technology::create($request->all());

        return redirect()->route('technologies.index')
            ->with('success', 'Technology created successfully.');
    }

    public function edit(Technology $technology)
    {
        return view('admin/technologies.edit', compact('technology'));
    }

    public function update(Request $request, Technology $technology)
    {
        $request->validate([
            'name' => 'required|unique:technologies,name,' . $technology->id,
        ]);

        $technology->update($request->all());

        return redirect()->route('technologies.index')
            ->with('success', 'Technology updated successfully.');
    }

    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('technologies.index')
            ->with('success', 'Technology deleted successfully.');
    }
}
