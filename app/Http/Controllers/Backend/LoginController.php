<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    function getLogin()
    {
        return view('backend.login');
    }

    function postLogin(LoginRequest $r)
    {
        $email=$r->email;
        $password=$r->password;
        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            // Auth::check() sẽ bằng true
            //Auth::user() lấy ra thông tin người đăng nhập từ bảng model User liên kết
            return redirect('admin');
        }
        return redirect()->back()->with('thongBao','Tài Khoản hoặc mật khẩu không chính xác! ');
    }
}
