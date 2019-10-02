<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function getListUser(){
        return view('backend.user.listuser');
    }
    function getAddUser(){
        return view('backend.user.adduser');
    }
    function getEditUser(){
        return view('backend.user.edituser');
    }
}
