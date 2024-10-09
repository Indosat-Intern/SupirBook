<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class IndexController extends Controller
{
    public function index()
{
    $drivers = Driver::where('status', 'active')->get();
    return view('customerss.index', compact('drivers'));
}
}
