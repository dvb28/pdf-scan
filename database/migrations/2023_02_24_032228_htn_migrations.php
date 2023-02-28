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
        Scheme::create('htn_migrations', function() {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->string('migration', 255)->collation()->nullable(false);
            $table->integer('batch', 11)->nullable(false);
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
