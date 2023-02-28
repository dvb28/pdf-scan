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
            $table->string('tokenable_type', 255)->collation()->nullable(false);
            $table->unsignedBigInteger('tokenable_id', 20)->nullable(false);
            $table->string('name', 255)->collation()->nullable(false);
            $table->string('token', 64)->collation()->nullable(false);
            $table->text('abilities')->collation();
            $table->timestamp('last_used_at')->default(null);
            $table->timestamp('expires_at')->default(null);
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
