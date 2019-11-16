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

            $product=Product::find($r->id_product);
            Cart::add([
              'id' => '293ad', 
              'name' => 'Product 1',
              'qty' => $r->quantity,
               'price' => 9.99,
              'weight' => 550, 
              'options' => ['img' => $product->img]]);

        return redirect('cart');
    }

    function delCart($rowId){
        Cart::remove($rowId);
        return redirect("/cart");
    }

    function updateCart($rowId,$qty){
       if( Cart::update($rowId, $qty)){
        return 'success';
       }
       else
       {
           return 'error';
       }
     
    }
}
