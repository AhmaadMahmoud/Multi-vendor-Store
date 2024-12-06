<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']); // Middleware Of All Routes in this Controller
    }
    public function index(){
        return view('dashboard.index');
    }
}
