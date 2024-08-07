<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\User;
use App\Models\Festival;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        $festivals = Festival::all();
        $plans = Plan::all();
        return view('admin.layouts.user', compact('users', 'festivals', 'plans'));
    }

    public function show($userId)
    {
        $user = User::findOrFail($userId); 
        return view('admin.layouts.viewuser', compact('user'));
    }
}
