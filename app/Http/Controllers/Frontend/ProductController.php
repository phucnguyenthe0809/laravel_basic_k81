<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function getDetail() {
        return view('frontend.product.detail');
    }
    function getShop() {
        return view('frontend.product.shop');
    }
}
