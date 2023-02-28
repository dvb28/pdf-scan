<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('htn-category', function(Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('parent_id')->default(0);
            $table->string('name', 255);
            $table->text('desc')->nullable();
            $table->string('image', 255)->nullable();
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
        //
    }
};
