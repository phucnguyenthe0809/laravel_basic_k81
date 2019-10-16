<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Category};
class ProductController extends Controller
{
   function getListProduct()
   {
      $data['products']=Product::paginate(4);
      return view('backend.product.listproduct',$data);
   }
   function getAddProduct()
   {
      return view('backend.product.addproduct');
   }
   function getEditProduct()
   {
      return view('backend.product.editproduct');
   }
}
