<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->bigIncrements('ID')->autoIncrement();
            $table->string('Username');
            $table->string('Password');
            $table->string('name');
            $table->integer('SDT');
            $table->date('Dob');
            $table->string('Avt');
            $table->timestamps();
        });
        // Schema::create('news', function (Blueprint $table) {
        //     $table->bigIncrements('IDBV',255)->autoIncrement();
        //     $table->bigInteger('IDND');
        //     $table->longText('Content');
        //     $table->string('Img');
        //     $table->dateTime('Dp');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account');
        // Schema::dropIfExists('news');
    }
}
