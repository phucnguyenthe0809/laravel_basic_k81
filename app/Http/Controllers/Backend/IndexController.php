<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class IndexController extends Controller
{
    function getIndex()
    {
        return view('backend.index');
    }
    function logout()
    {
        Auth::logout();
        //xoá session Auth::user()
        //chuyển Auth::check() =>false
        return redirect('login');
    }
}
