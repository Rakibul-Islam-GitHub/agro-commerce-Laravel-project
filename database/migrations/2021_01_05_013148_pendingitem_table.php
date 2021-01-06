<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PendingitemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendingitems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('creatorid');
            $table->string('creatorname');
            $table->string('title');
            $table->float('price');
            $table->text('description');
            $table->string('image');
            $table->string('createtime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendingitems');
    }
}
