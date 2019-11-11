<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOutRequest;
use Illuminate\Http\Request;
use Cart;
use App\Models\Order;
use App\Models\ProductOrder;

class CheckoutController extends Controller
{
    function getCheckout() {
        $data['products']=Cart::content();
        $data['total']=Cart::total(0,"",".");
       return view('frontend.checkout.checkout',$data);
    }
    function postCheckout(CheckOutRequest $r){
        $total=Cart::total(0,"","");
        $order=new Order;
        $order->full=$r->full;
        $order->address=$r->address;
        $order->email=$r->email;
        $order->phone=$r->phone;
        $order->total=$total;
        $order->state=2;
        $order->save();
        foreach (Cart::content() as $row) {
            $prdOrder=new ProductOrder;
            $prdOrder->code=$row->id;
            $prdOrder->name=$row->name;
            $prdOrder->price=$row->price;
            $prdOrder->qty=$row->qty;
            $prdOrder->img=$row->options->img;

            $prdOrder->order_id= $order->id;
            $prdOrder->save();
         }
         Cart::destroy();
        return redirect('/checkout/complete/'.$order->id);
    }


    function getComplete($idOrder) {

        $data['order']=order::find($idOrder);
        return view('frontend.checkout.complete',$data);
    }
}
