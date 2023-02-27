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
            $table->id()->unsignedBigInteger()->nullable(false);
            $table->integer('type_id', 11)->nullable(false);
            $table->integer('parent_id', 11)->nullable(false)->default('0');
            $table->string('name', 255)->collation()->nullable(false);
            $table->text('desc')->collation();
            $table->string('image', 255)->collation()->default(null);
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
