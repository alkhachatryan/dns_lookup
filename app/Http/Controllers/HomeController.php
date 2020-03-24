<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * The home page view.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    */
    public function index(){
        return view('home');
    }
}
