<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\heroBanner;
use App\Models\features;
use App\Models\portfolio;
use App\Models\pages;

class homeController extends Controller
{
    public function index(){

        $heros = heroBanner::get();
        $features = features::get();
        $portfolios = portfolio::get();
        $pages = pages::get();

        return view('index',['heros'=>$heros, 'portfolios'=>$portfolios, 'features'=>$features, 'pages'=>$pages]);
    }

    public function contact(){
        return view('contact');
    }
}
