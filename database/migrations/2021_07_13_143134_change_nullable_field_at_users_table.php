<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNullableFieldAtUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('address')->nullable()->change();
            $table->string('districts')->nullable()->change();
            $table->integer('villages')->nullable()->change();
            $table->integer('zip_code')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('store_name')->nullable()->change();
            $table->integer('categories_id')->nullable()->change();
            $table->integer('store_status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('address')->nullable(false)->change();
            $table->string('districts')->nullable(false)->change();
            $table->integer('villages')->nullable(false)->change();
            $table->integer('zip_code')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->string('store_name')->nullable(false)->change();
            $table->integer('categories_id')->nullable(false)->change();
            $table->integer('store_status')->nullable(false)->change();
        });
    }
}
