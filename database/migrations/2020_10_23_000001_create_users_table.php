<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('userName', 64)->comment('Họ tên');
            $table->string('userEmail', 255);
            $table->string('userPhone', 255);
            $table->char('userGender', 1)->default(getConfig('user.userGender.girl'))->comment('1 boy, 2 girl');
            $table->date('userBirthDay')->nullable()->comment('Ngày sinh');
            $table->string('userAvatar', 255)->nullable();
            $table->integer('userProvinceId')->nullable();
            $table->integer('userDistrictId')->nullable();
            $table->string('userAddress', 255)->nullable();
            $table->char('userStatus', 1)->default(1)->comment('1: active, 2: disable');
            $table->timestamp(getSystemConfig('created_at_column'))->useCurrent();
            $table->timestamp(getSystemConfig('updated_at_column'))->nullable();
            $table->char(getSystemConfig('deleted_at_column'))->default(0)->comment('deleted:1, active:0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
