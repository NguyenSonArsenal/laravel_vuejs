<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 255)->comment('Họ tên học sinh viết in hoa');
            $table->string('address', 255)->nullable()->comment('Địa chỉ thường trú');
            $table->char('gender', 1)->default('M')->comment('Giới tính học sinh: M - nam, F - nữ');
            $table->string('phone_number', 255)->nullable()->comment('SĐT');
            $table->date('date_of_birth')->nullable()->comment('Sinh nhật học sinh định dạng: YYYY-mm-dd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
