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
        Schema::table('htn_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->string('title', 250)->collation()->nullable(false);
            $table->string('thumbnail', 250)->collation()->default(null);
            $table->string('slug', 150)->collation()->nullable(false);
            $table->string('description', 200)->collation()->default(null);
            $table->longText('content')->collation();
            $table->string('status', 50)->collation()->nullable(false)->default('draft');
            $table->integer('views', 20)->nullable(false)->default('0');
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
