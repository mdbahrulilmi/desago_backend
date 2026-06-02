<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAppUserIdToUserIdInAppSocialmedias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_socialmedias', function (Blueprint $table) {
            $table->dropForeign(['app_user_id']);
            $table->renameColumn('app_user_id', 'user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('app_users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_socialmedias', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->renameColumn('user_id', 'app_user_id');
            $table->foreign('app_user_id')
                  ->references('id')
                  ->on('app_users')
                  ->onDelete('cascade');
        });
    }
}