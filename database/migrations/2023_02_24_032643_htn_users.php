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
        Schema::create('htn_users', function(Blueprint $table) {
            $table->unsignedBigInteger('id', 20)->nullable(false);
            $table->string('name', 255)->collation()->nullable(false);
            $table->string('email', 150)->collation()->nullable(false);
            $table->string('user_name', 255)->collation()->nullable(false);
            $table->string('phone', 150)->collation()->default(null);
            $table->string('address', 255)->collation()->default(null);
            $table->integer('organizational_id', 11)->default(null);
            $table->integer('postion_id', 11)->default(null);
            $table->timestamp('email_verified_at', 11)->default(null);
            $table->string('password', 255)->collation()->default(null);
            $table->string('remember_token', 255)->collation()->default(null);
            $table->string('avatar', 255)->collation()->default(null);
            $table->integer('is_admin', 11)->default('0');
            $table->string('status', 50)->collation()->default('active');
            $table->string('status', 5)->collation()->default('vi');
            $table->text('data')->collation();
            $table->json('json_metas')->default(null);
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
