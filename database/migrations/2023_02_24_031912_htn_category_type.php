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
        Schema::create('htn_category_type', function($table) {
            $table->unsignedBigInteger()->nullable(false);
            $table->string('name', 255)->nullable(false);
            $table->text('desc')->collation()->default(null);
            $table->string('image', 255)->collation()->default(null);
            $table->integer('order')->default(null);
            $table->string('type', 100)->collation()->default(null);
            $table->timestamp();
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
