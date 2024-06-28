<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Festival;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $festivals = Festival::all();
        return view('admin.dashboard', compact('users', 'festivals'));
    }

    public function showUsers()
    {
        $users = User::paginate(10);
        return view('admin.layouts.user', compact('users'));
    }

    public function showFestivals()
    {
        $festivals = Festival::paginate(10);
        return view('admin.layouts.festivals', compact('festivals'));
    }
}
