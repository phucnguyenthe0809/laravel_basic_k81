<?php

namespace App\Http\Controllers\Backend;
//khai báo sử dung thư viện str
use Illuminate\Support\Str;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{

    function getCategory()
    {
        $data['categories']=Category::all()->toarray();
        return view('backend.category.category',$data);
    }

    function getEditCategory($idCate)
    {
        $data['cate']=Category::find($idCate);
        $data['categories']=Category::all()->toarray();
        return view('backend.category.editcategory',$data);
    }

    function postEditCategory($idCate,EditCategoryRequest $r)
    {
        $cate=Category::findOrFail($idCate);
        $cate->name=$r->name;
        $cate->slug=Str::slug($r->name,'-');
        $cate->parent=$r->parent;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã Sửa thành công.');
    }

    function postCategory(AddCategoryRequest $r)
    {
        //phiên bản 6.0
        //khai báo thư viện Str:     use Illuminate\Support\Str;
        //phiên bản 5.8
        //không cần khai báo thư viện Str : dùng str_slug('giá trị cần chuyển')
        $categories=category::all()->toArray();
        if(getLevel($categories, $r->idParent, 1)<3) {
            $cate=new Category;
            $cate->name=$r->name;
            $cate->slug=Str::slug($r->name,'-');
            $cate->parent=$r->parent;
            $cate->save();
            return redirect()->back();
        }else {
            return redirect()->back()->withErrors(['name'=>'Trang web không hỗ trợ danh mục > 2 cấp']);
        }
}
    function delCategory($idCate)
    {
        //tìm danh mục muốn xoá
        $cate=Category::find($idCate);

        //lấy parent danh mục xoá
        $parent=$cate->parent;
        // cập nhật parent của danh mục con = parent của danh mục xoá
        Category::where('parent', $cate->id)->update(['parent'=>$parent]);
        //xoá danh mục
        Category::destroy($idCate);
        return redirect()->back();
    }
}
