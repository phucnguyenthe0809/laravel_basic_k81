<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    function getListUser(){
        $data['users']=User::paginate(3);
        return view('backend.user.listuser',$data);
    }
    function getAddUser(){
        return view('backend.user.adduser');
    }
    function postAddUser(AddUserRequest $r)
    {
        $user=new User;
        $user->email=$r->email;
        $user->password=bcrypt($r->password);
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();
        return redirect('admin/user')->with('thongbao','Đã thêm thành công!');

    }

    function getEditUser($idUser){
        $data['user']=User::findOrFail($idUser);
        return view('backend.user.edituser',$data);
    }

    function delUser($idUser)
    {
        User::destroy($idUser);
        return redirect()->back();
    }
    function postEditUser($idUser,EditUserRequest $r)
    {
        $user=User::find($idUser);
        $user->email=$r->email;
        if($r->password!="")
        {
            $user->password=bcrypt($r->password);
        }
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();
        return redirect()->back();
    }
}
