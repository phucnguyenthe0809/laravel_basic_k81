<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
             
            $table->bigIncrements('id');
            $table->string('full'); 
            $table->string('address')->nullable();  //cho phép để trống cột address
            $table->string('email'); 
            $table->string('phone'); 
            $table->decimal('total',18);
            $table->tinyInteger('state')->unsigned(); // state Kiểu tinyInt  Dạng không dấu
            $table->timestamps(); // Tạo 2 cột created_at, update_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
