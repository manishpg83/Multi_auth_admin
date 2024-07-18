<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Festival;
use App\Models\Client;
use DataTables;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view with festivals and clients data.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $festivals = Festival::latest()->get();
            $clients = Client::all();

            return DataTables::of($festivals)
                ->addColumn('actions', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('dashboard');
    }

    public function client_list(Request $request)
    {
        if ($request->ajax()) {
            $festivals = Festival::latest()->get();
            $clients = Client::all();

            return DataTables::of($clients)
                ->addColumn('actions', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('dashboard');
    }
}
