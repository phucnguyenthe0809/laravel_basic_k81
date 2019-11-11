<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Category};

class ProductController extends Controller
{
    function getDetail($slug) {
        $array=explode('-',$slug);
        $id=array_pop($array);
        $data['prd']=Product::find($id);
        $data['sp_new']=Product::where('img','<>','no-img.jpg')
        ->orderBy('updated_at','desc')->take(4)->get();
        return view('frontend.product.detail',$data);
    }


    function getShop(request $r) {
        if ($r->start!='') {
            $data['products']=Product::whereBetween('price', [$r->start, $r->end])->paginate(2);
        } else {
            $data['products']=Product::paginate(2);
        }

        $data['categories']=Category::all();

        return view('frontend.product.shop',$data);
    }
    function getCatePrd(request $r,$slug_cate){
        if ($r->start!='') {
            $data['products']=Category::where('slug',$slug_cate)
        ->first()->product()->whereBetween('price', [$r->start, $r->end])->paginate(2);
        } else {
            $data['products']=Category::where('slug',$slug_cate)
        ->first()->product()->paginate(2);
        }

        $data['categories']=Category::all();

        return view('frontend.product.shop',$data);
    }
}
