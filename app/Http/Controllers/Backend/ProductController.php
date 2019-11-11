<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use Illuminate\Http\Request;
use App\Models\{Product,Category};
use Illuminate\Support\Str;
class ProductController extends Controller
{
   function getListProduct()
   {
      $data['products']=Product::paginate(4);
      return view('backend.product.listproduct',$data);
   }
   function getAddProduct()
    {
        $data['categories'] = Category::all()->toarray();
        return view('backend.product.addproduct', $data);
    }

    function postAddProduct(AddProductRequest $r)
    {
        $prd = new Product;
        $prd->code = $r->code;
        $prd->name = $r->name;
        $prd->slug = Str::slug($r->name);
        $prd->price = $r->price;
        $prd->featured = $r->featured;
        $prd->state = $r->state;
        $prd->info = $r->info;
        $prd->describe = $r->describe;
        if ($r->hasFile('img')) {
            $file = $r->img;
            $filename = Str::slug($r->name) . '.' . $file->getClientOriginalExtension();
            $file->move('backend/img', $filename);
            $prd->img = $filename;
        } else {
            $prd->img = 'no-img.jpg';
        }

        $prd->category_id = $r->category;
        $prd->save();
        return redirect('admin/product')->with('thongbao','Đã Thêm Thành Công');
    }

    function getEditProduct($idPrd)
    {

        $data['product']=product::find($idPrd);
        $data['categories'] = category::all()->toarray();
        return view('backend.product.editproduct',$data);
    }

    function postEditProduct(EditProductRequest $r,$idPrd)
    {
        $prd = Product::find($idPrd);
        $prd->code = $r->code;
        $prd->name = $r->name;
        $prd->slug = Str::slug($r->name);
        $prd->price = $r->price;
        $prd->featured = $r->featured;
        $prd->state = $r->state;
        $prd->info = $r->info;
        $prd->describe = $r->describe;
        if ($r->hasFile('img')) {

            if($prd->img!='no-img.jpg')
            {
                if(file_exists('backend/img/'.$prd->img))
                {
                    //xóa file nếu tồn tại trong public
                    unlink('backend/img/'.$prd->img);
                }

            }
            //lấy đường dẫn file tương đối
            $file = $r->img;
            //lấy tên file để upload lên serve
            $filename = Str::slug($r->name) . '.' . $file->getClientOriginalExtension();
            //UPload file lên serve
            //  $file->move('đường dẫn lưu file','tên file được lưu trên serve')
            $file->move('backend/img', $filename);
            //lưu tên file vào CSDL
            $prd->img = $filename;
        }

        $prd->category_id = $r->category;
        $prd->save();
        return redirect()->back()->with('thongbao','Đã sửa Thành Công');

    }
    function delProduct($idPrd)
    {
        Category::destroy($idPrd);
        return redirect('admin/product')->with('thongbao','Đã Xoá Thành Công!');
    }
}

