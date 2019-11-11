<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class CartController extends Controller
{
    function getCart() {

        $data['products']=Cart::content();
        $data['total']=Cart::total(0,"",".");
       return view('frontend.cart.cart',$data);
    }

    function addCart(request $r) {
        if(isset($r->quantity)){
            $product=Product::find($r->id_product);
            Cart::add(['id' => $product->code,
            'name' => $product->name,
            'qty' => $r->quantity,
            'price' => $product->price,
            'weight' => 0,
            'options' => ['img' => $product->img]]);
        }else{
            $product=Product::find($r->id_product);
            Cart::add(['id' => $product->code,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'weight' => 0,
            'options' => ['img' => $product->img]]);
        }


        return redirect('cart');
    }

    function delCart($rowId){
        Cart::remove($rowId);
        return redirect("/cart");
    }

    function updateCart($rowId,$qty){
        Cart::update($rowId, $qty);
        return 'success';
    }
}
