<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    function getOrder()
    {
        $data['orders']=Order::where('state',2)->get();
        return view('backend.order.order',$data);
    }
    function getDetailOrder($idOrder)
    {
        $data['order']=Order::findOrFail($idOrder);
        return view('backend.order.detailorder',$data);
    }
    function getProcessed()
    {
        $data['orders']=Order::where('state',1)->get();
        return view('backend.order.processed',$data);
    }
    function xuLy($idOrder)
    {
        $order=Order::find($idOrder);
        $order->state=1;
        $order->save();
        return redirect('admin/order/processed');
    }
}
