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
        Schema::create('htn_languages', function(Blueprint $table) {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->string('code', 255)->collation()->nullable(false);
            $table->text('text')->collation();
            $table->string('position', 100)->collation()->nullable(false);
            $table->string('location', 10)->collation()->nullable(false);
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
