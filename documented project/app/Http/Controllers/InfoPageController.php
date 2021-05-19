<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoPageController extends Controller
{

    /**
     * Generise about stranicu
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAbout(){
        return view('misc.about');
    }
}
