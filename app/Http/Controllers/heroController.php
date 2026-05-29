<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class heroController extends Controller
{
    public function heroBanner(){
        // $heros = heroBanner::get();
        return view('heroBanner');
    }

    public function features(){
            return view('features');
    }

    public function portfolio(){
            return view('portfolio');
    }

    public function pages(){
            return view('pages');
    }

    public function feedBack(){
            return view('feed-back');
    }
}
