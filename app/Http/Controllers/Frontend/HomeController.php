<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function getAbout() {
        return view('frontend.about');
    }
     function getContact() {
       return view('frontend.contact');
    }
    function getIndex() {
        return view('frontend.index');
    }
}
