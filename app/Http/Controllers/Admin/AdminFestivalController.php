<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Festival;

class AdminFestivalController extends Controller
{
    public function index()
    {
        $festivals = Festival::paginate(10);
        return view('admin.layouts.festivals', compact('festivals'));
    }

    public function create()
    {
        return view('admin.layouts.create_festival');
    }

    public function edit(Festival $festival)
    {
        return view('admin.layouts.edit_festival', compact('festival'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'email_scheduled' => 'nullable|string|max:500',
            'subject_line' => 'nullable|string|max:255',
            'email_body' => 'nullable|string',
        ]);

        $festival = Festival::create($validatedData);

        if ($festival) {
            notyf()->success('Festival created successfully.');            
            return redirect()->back()->with('success', 'Festival created successfully.');
        } else {
            notyf()->error('Failed to create festival.');
            return redirect()->back()->with('error', 'Failed to create festival.');
        }
    }

    public function update(Request $request, Festival $festival)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'email_scheduled' => 'nullable|string|max:255',
            'subject_line' => 'nullable|string|max:255',
            'email_body' => 'nullable|string',
        ]);

        $festival->update($validatedData);
        notyf()->success('Festival updated successfully.');
        return redirect()->back()->with('success', 'Festival updated successfully.');
    }


    public function destroy(Festival $festival)
    {
        $festival->delete();
        notyf()->success('Festival deleted successfully.');
        return redirect()->back()->with('success', 'Festival deleted successfully.');
    }
}