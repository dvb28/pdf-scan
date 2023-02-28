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
        Schema::table('htn_organizational', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->string('name', 255)->collation()->nullable(false);
            $table->integer('parent_id', 11)->default('0');
            $table->string('code', 255)->default(null);
            $table->string('desc', 255)->default(null);
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
