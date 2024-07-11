<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Festival;
use App\Models\Plan;


class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $festivals = Festival::all();
        $plans = Plan::all();
        return view('admin.dashboard', compact('users', 'festivals', 'plans'));
    }

    public function showUsers()
    {
        $users = User::paginate(10);
        $festivals = Festival::all();
        $plans = Plan::all();
        return view('admin.layouts.user', compact('users', 'festivals', 'plans'));
    }

    public function showFestivals()
    {
        $festivals = Festival::paginate(10);
        return view('admin.layouts.festivals', compact('festivals'));
    }

    public function showPlan()
    {
        $plans = Plan::paginate(10); // Adjust as per your pagination needs
        return view('admin.layouts.plans.index', compact('plans'));
    }

}