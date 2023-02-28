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
        Schema::create('htn_model_has_roles', function() {
            $table->unsignedBigInteger('role_id', 20)->nullable(false);
            $table->unsignedBigInteger('model_type')->nullable(false);
            $table->unsignedBigInteger('model_id')->nullable(false);
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
