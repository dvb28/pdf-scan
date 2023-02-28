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
        Schema::table('htn_profile_type', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->string('name', 255)->collation()->nullable(false);
            $table->string('desc', 255)->collation()->default(null);
            $table->string('status', 50)->collation()->default(null);
            $table->string('rules_file', 200)->collation()->default(null);
            $table->string('lang', 10)->collation()->default(null);
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
