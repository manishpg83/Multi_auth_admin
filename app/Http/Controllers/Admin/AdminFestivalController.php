<?php

namespace App\Http\Controllers\Admin;

use App\Models\Festival;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AdminFestivalController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $festivals = Festival::select(['festival_id', 'name', 'date', 'status', 'subject_line', 'email_body']);
            return DataTables::of($festivals)
                ->addColumn('actions', function ($festival) {
                    return '<a href="#" class="btn btn-sm btn-primary edit-btn" data-festival-id="' . $festival->festival_id . '">Edit</a> | 
                             <a href="#" class="btn btn-sm btn-danger delete-btn" data-festival-id="' . $festival->festival_id . '">Delete</a>';
                })
                ->editColumn('status', function ($festival) {
                    return ucfirst($festival->status);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.layouts.festivals');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:Active,Inactive',
            'email_scheduled' => 'nullable|in:Yes,No',
            'subject_line' => 'nullable|string|max:255',
            'email_body' => 'nullable|string',
        ]);

        $festival = Festival::create($validatedData);

        if ($festival) {
            return response()->json([
                'success' => true,
                'message' => 'Festival created successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create festival.'
            ]);
        }
    }

    public function edit(Festival $festival)
    {
        return response()->json($festival);
    }

    public function update(Request $request, Festival $festival)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:Active,Inactive',
            'email_scheduled' => 'required|in:Yes,No',
            'subject_line' => 'nullable|string|max:255',
            'email_body' => 'nullable|string',
        ]);

        $festival->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Festival updated successfully'
        ]);
    }

    public function destroy(Festival $festival)
    {
        $festival->delete();
        return response()->json([
            'success' => true,
            'message' => 'Festival deleted successfully'
        ]);
    }
}