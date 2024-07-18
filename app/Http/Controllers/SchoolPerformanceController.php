<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolPerformanceController extends Controller
{
    public function vr()
    {
        return view("pages.schools-performance");
    }
}
