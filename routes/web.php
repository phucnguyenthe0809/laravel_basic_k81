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

// ---------------BACKEND
Route::get('login','Backend\LoginController@getLogin')->middleware('checkLogout'); 
Route::post('login','Backend\LoginController@postLogin'); 

Route::group(['prefix' => 'admin','middleware'=>'checkLogin'], function () {
    Route::get('logout','Backend\IndexController@logout'); 
    Route::get('','Backend\IndexController@getIndex'); 
    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('','Backend\CategoryController@getCategory');
        Route::post('','Backend\CategoryController@postCategory');
        Route::get('edit/{idCate}','Backend\CategoryController@getEditCategory');
        Route::post('edit/{idCate}','Backend\CategoryController@postEditCategory');
        Route::get('delete/{idCate}','Backend\CategoryController@delCategory');
    });

    //order
    Route::group(['prefix' => 'order'], function () {
        Route::get('','Backend\OrderController@getOrder');
        Route::get('detail/{idOrder}','Backend\OrderController@getDetailOrder');
        Route::get('processed','Backend\OrderController@getProcessed');
        Route::get('xu-ly/{idOrder}', 'Backend\OrderController@xuLy');
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
        Route::post('add','Backend\UserController@postAddUser');
        Route::get('edit/{idUser}','Backend\UserController@getEditUser');
        Route::post('edit/{idUser}','Backend\UserController@postEditUser');
        Route::get('del/{idUser}','Backend\UserController@delUser');
    });
    
});




// ----------------------LÝ THUYẾT

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

Route::get('test-model', function () {
    $user=new App\User;
    $user->email='A@gmail.com';
    $user->password=bcrypt('123456');
    $user->full='nguyễn A';
    $user->address='Địa chỉ A';
    $user->phone='123456789';
    $user->level='2';
    $user->save();
});

Route::group(['prefix' => 'lien-ket'], function () {
        // chú ý:
        //bảng chính là bảng chứa khoá chính
        //bảng phụ là bảng chứa khoá ngoại (thương sẽ đặt tên bảng :     [Tên bảng liên kêt]_id )

        //hasOne() :liên kết 1-1 theo chiều thuận  (từ bảng chứa khoá chính sang bảng chứa khoá ngoại)
        //BelongsTo() :liên kết 1-1 theo chiều Nghịch (Từ bảng chứa khoá ngoại sang bảng chứa khoá chính)
        //hasMany(): liên kết 1-n
        //BelongsToMany: liên kết n-n
      

        // liên kết 1-1 theo chiều thuận
        Route::get('lk-1-1-t', function () {
            $user=App\User::find(14);
            $info=$user->lien_ket_den_bang_info()->first();
            dd($info->toArray());
        });



        // liên kết 1-1 theo chiều nghịch

        Route::get('lk-1-1-n', function () {
            $info=App\Models\info::find(2);
            $user=$info->lien_ket_den_bang_users()->first();
            dd($user->toArray());
        });


        // liên kết 1-n

        Route::get('lk-1-n', function () {
            $data['cate']=App\Models\Category::find(6);
            // $products=$cate->lien_ket_den_bang_product()->get();
            // dd($products->toArray());
            return view('test',$data);
        });


        // liên kết n-n
        
});


