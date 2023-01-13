<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //Home
    function home() {
        return view('welcome');
    }
}
