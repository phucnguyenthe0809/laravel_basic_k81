<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






Route::get('','Frontend\HomeController@getIndex' );
Route::get('about', 'Frontend\HomeController@getAbout');
Route::get('contact','Frontend\HomeController@getContact');


//cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('', 'Frontend\CartController@getCart');
});

// checkout
Route::group(['prefix' => 'checkout'], function () {
    Route::get('', 'Frontend\CheckoutController@getCheckout');
    Route::get('complete', 'Frontend\CheckoutController@getComplete');
});

// product
Route::group(['prefix' => 'product'], function () {
    Route::get('shop','Frontend\ProductController@getShop' );
    Route::get('detail','Frontend\ProductController@getDetail' );
});

//
Route::group(['prefix' => 'query'], function () {

    Route::get('insert', function () {
        //tham số trong insert là 1 mảng
        //trong users có trường email,password,full,address,phone,level
        //khởi tạo 1 bản ghi trong user
        // DB::table('users')->insert([
        //     'email'=>'A@gmail.com',
        //     'password'=>'123456',
        //     'full'=>'nguyen A',
        //     'address'=>'khu A',
        //     'phone'=>'1111',
        //     'level'=>1 ]);

        //tạo nhiều bản ghi cùng lúc
        DB::table('users')->insert([
            ['email'=>'B@gmail.com','password'=>'123456','full'=>'nguyen B','address'=>'khu B','phone'=>'2222','level'=>1 ],
            ['email'=>'C@gmail.com','password'=>'123456','full'=>'nguyen C','address'=>'khu C','phone'=>'3333','level'=>1 ],
            ['email'=>'D@gmail.com','password'=>'123456','full'=>'nguyen D','address'=>'khu D','phone'=>'4444','level'=>1 ]
            ]);
    });

    //sửa sữa liệu

    Route::get('update', function () {
        //where('trường cần kiểm tra','điều kiện','giá trị so sánh');
        //where có 2 tham số thì mặc định là =
        DB::table('users')->where('id',9)->update(['level'=>1]);
    });

    //xoá 
    Route::get('delete', function () {
        //xoá theo điều kiện
        // DB::table('users')->where('id',9)->delete();

        //xoá không điều kiện (xoá tất cả bản ghi)
        DB::table('users')->delete();
    });

    //nâng cao
    //lấy dữ liệu bằng querybuilder
    // chú ý : muốn lấy dữ liệu bắt buộc phải kết thúc bằng get() hoặc first
    //lấy toàn bộ dữ liệu
    Route::get('get-all-data', function () {
        $users=DB::table('users')->get();
        dd($users);
    });


    //lấy bản ghi đầu tiên
    Route::get('get-first-data', function () {
        $user=DB::table('users')->first();
        dd($user->email);
    });


    //select chọn các trường cần lấy
    Route::get('select', function () {
        $users=DB::table('users')->select('id','full')->get();
        dd($users);
    });

    //where () lấy dữ liệu theo điều kiện
    Route::get('where-and', function () {
        $users=DB::table('users')->where('id','>',13)->where('id','<',16)->get();
        dd($users);
    });

    Route::get('where-between', function () {
        $users=DB::table('users')->whereBetween('id',[13,15])->get();
        dd($users);
    });

    Route::get('where-or', function () {
        $users=DB::table('users')->where('id','<',14)->orwhere('id','>',15)->get();
        dd($users);
    });

    //limit giới hạn bản ghi

    Route::get('limit', function () {
        //skip(1) đứng từ vị trí 1   take(2) lấy 2 phần tử
        $users=DB::table('users')->skip(1)->take(2)->get();
        dd($users);
    });

    //đếm số bản ghi

    Route::get('count', function () {
        $soBanGhi=DB::table('users')->count();
        dd($soBanGhi);
    });

    //sắp xếp
    Route::get('orderby', function () {
        //ASC tăng dần, DESC giảm dần
        $dlSapXep=DB::table('users')->orderby('id','DESC')->get();
        dd($dlSapXep);
    });

    //cộng dồn
    Route::get('sum', function () {
        $ketQua=DB::table('users')->where('id','>',13)->sum('id');
        dd($ketQua);

    });

     //cộng Tính giá trị trung bình
     Route::get('avg', function () {
        $ketQua=DB::table('users')->where('id','>',13)->avg('id');
        dd($ketQua);

    });



});










// ---------------BACKEND

Route::get('login','Backend\LoginController@getLogin'); 


Route::group(['prefix' => 'admin'], function () {

    Route::get('','Backend\IndexController@getIndex'); 

    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('','Backend\CategoryController@getCategory');
        Route::post('','Backend\CategoryController@postCategory');
        Route::get('edit','Backend\CategoryController@getEditCategory');
    });

    //order
    Route::group(['prefix' => 'order'], function () {
        Route::get('','Backend\OrderController@getOrder');
        Route::get('detail','Backend\OrderController@getDetailOrder');
        Route::get('processed','Backend\OrderController@getProcessed');
    });

    //product
    Route::group(['prefix' => 'product'], function () {
        Route::get('','Backend\ProductController@getListProduct');
        Route::get('add','Backend\ProductController@getAddProduct');
        Route::get('edit','Backend\ProductController@getEditProduct');
    });

    //user
    Route::group(['prefix' => 'user'], function () {
        Route::get('','Backend\UserController@getListUser');
        Route::get('add','Backend\UserController@getAddUser');
        Route::get('edit','Backend\UserController@getEditUser');
    });
    
});


