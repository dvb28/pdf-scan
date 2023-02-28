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
        Schema::table('htn_department_in_charge', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->integer('user_id', 11)->nullable(false);
            $table->integer('organizational_id', 11)->nullable(false);
            $table->integer('postion_id', 11)->default(null);
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
        Schema::table('charge', function (Blueprint $table) {
            //
        });
    }
};
