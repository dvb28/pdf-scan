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
        Schema::table('htn_shop_language', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->string('code', 50)->collation()->nullable(false);
            $table->string('icon', 50)->collation()->default(null);
            $table->tinyInteger('status', 4)->default('0');
            $table->tinyInteger('rtl', 4)->default('0')->comment('Layout RTL');
            $table->integer('sort', 11)->default(null);
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
