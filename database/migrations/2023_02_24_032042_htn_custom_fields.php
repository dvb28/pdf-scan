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
        Schema::create('htn_custom_fields', function($table) {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->string('name', 255)->collation()->nullable(false);
            $table->text('desc')->collation()->nullable();
            $table->string('image', 255)->collation()->nullable(false);
            $table->integer('order', 11)->default(null);
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
