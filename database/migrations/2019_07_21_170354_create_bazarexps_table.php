<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBazarexpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bazarexps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('manual_date');
            $table->integer('ammount');
            $table->integer('member_id');
            $table->integer('manager_id');
            $table->boolean('delete_st')->default('0');
            $table->integer('user_id');
            $table->integer('admin_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bazarexps');
    }
}
