<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Mail;
class HomeController extends Controller
{
    function sendMail(request $r)
    {
        $data['name']='Nguyễn thế phúc';
        $data['email']=$r->email;
       Mail::send('mail', $data, function ($message) use ($data) {
           $message->from('phucngyenthe0809@gmail.com', 'VIEPRO SHOP');
           $message->to(  $data['email'], 'Khách hàng');
           $message->subject('Xác nhận đơn hàng');

       });
  
    }
    function getAbout() {
        return view('frontend.about');
    }
     function getContact() {
       return view('frontend.contact');
    }
    function getIndex() {
        $data['sp_new']=Product::where('img','<>','no-img.jpg')
        ->orderBy('updated_at','desc')->take(4)->get();
        $data['sp_hot']=Product::where('img','<>','no-img.jpg')->where('featured',1)
        ->orderBy('updated_at','desc')->take(4)->get();
        return view('frontend.index',$data);
    }
}
