<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\Order;
class IndexController extends Controller
{
    function getIndex()
    {
        $year=Carbon::now()->format('Y');
        $month=Carbon::now()->format('m');
        for ($i=1; $i <= $month ; $i++) {
            $dl['Tháng '.$i]=Order::where('state',1)
            ->whereMonth('updated_at',$i)
            ->whereYear('updated_at',$year)
            ->sum('total');
        }
        $data['month']=$month;
        $data['order']=Order::where('state',1)->whereMonth('updated_at',$month);
        $data['dl']=$dl;
        return view('backend.index',$data);
    }
    function logout()
    {
        Auth::logout();
        //xoá session Auth::user()
        //chuyển Auth::check() =>false
        return redirect('login');
    }
}
