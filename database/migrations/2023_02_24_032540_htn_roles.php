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
        Schema::table('htn_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->string('name', 255)->collation()->nullable(false);
            $table->text('desc')->collation();
            $table->string('guard_name', 255)->collation()->nullable(false);
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
