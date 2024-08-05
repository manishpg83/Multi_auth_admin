<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadClientController extends Controller
{
    public function index(){
        return view('pages.upload_client');
    }
}
