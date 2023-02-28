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
        Schema::create('htn_stg_file', function(Blueprint $table) {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->string('parent_id', 255)->collation()->default(null);
            $table->string('slug', 255)->collation()->default(null);
            $table->string('type', 255)->collation()->default(null);
            $table->string('document_type', 255)->collation()->default(null);
            $table->string('profile_type_id', 255)->collation()->default(null);
            $table->string('ext', 100)->collation()->default(null);

            // Các fill
            for($i = 1; $i < 46; $i++) {
                $table->string("htn_$i")->collation()->default(null);
            }
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
