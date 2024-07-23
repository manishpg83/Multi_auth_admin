<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FestivalController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $festivals = Festival::select(['festival_id', 'name', 'date', 'status', 'subject_line', 'email_body']);
            return DataTables::of($festivals)
                ->addColumn('actions', function ($festival) {
                    return '<a href="#" class="text-indigo-600 hover:text-indigo-900 view-btn" data-festival-id="' . $festival->festival_id . '">
                                <i class="fas fa-eye"></i>
                            </a>';
                })
                ->editColumn('status', function ($festival) {
                    $status = ucfirst($festival->status);
                    $colorClass = $festival->status === 'Active' ? 'text-green-600' : 'text-red-600';
                    return '<span class="' . $colorClass . '">' . $status . '</span>';
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }
        return view('layouts.festivals');
    }

    public function show(Festival $festival)
    {
        return response()->json($festival);
    }

    // You might want to add a method to let users view their participation or related data
    public function userParticipation(Festival $festival)
    {
        // Assuming you have a relationship between User and Festival
        $participation = auth()->user()->participations()->where('festival_id', $festival->id)->first();
        
        return response()->json([
            'festival' => $festival,
            'participation' => $participation
        ]);
    }

    // If users can interact with festivals (e.g., sign up), you might add methods like:
    public function signup(Request $request, Festival $festival)
    {
        // Validate request
        $validatedData = $request->validate([
            // Add validation rules
        ]);

        // Process signup
        $participation = auth()->user()->participations()->create([
            'festival_id' => $festival->id,
            // Add other relevant data
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully signed up for the festival',
            'participation' => $participation
        ]);
    }

    // You can add more user-specific methods as needed
}