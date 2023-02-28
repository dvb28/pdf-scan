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
        Schema::table('htn_post_metas', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->unsignedBigInteger('post_id', 20)->nullable(false);
            $table->string('meta_key', 150)->collation()->nullable(false);
            $table->text('meta_value')->collation();
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
