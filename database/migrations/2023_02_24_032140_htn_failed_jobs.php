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
        Schema::table('htn_failed_jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->string('uuid', 255)->collation()->nullable(false);
            $table->text('connection')->collation()->nullable(false);
            $table->text('queue')->collation()->nullable(false);
            $table->longText('payload')->collation()->nullable(false);
            $table->longText('exception')->collation()->nullable(false);
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
