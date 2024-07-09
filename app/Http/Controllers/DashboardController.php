<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:dashboard', ['only' => ['__invoke']]);
    }

    public function __invoke()
    {
        // dd(Auth::user()->image_url);
        return view('backEnd.dashboard.index');
    }
}
