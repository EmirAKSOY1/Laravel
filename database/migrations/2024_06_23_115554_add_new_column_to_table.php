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
        Schema::table('users', function (Blueprint $table) {
            // Yeni sütunu eklemek için Blueprint kullanarak 'new_column' adında bir sütun ekleyelim
            $table->string('username')->after('id')->nullable();
            $table->timestamp('auth_start')->after('tc')->nullable();
            $table->timestamp('auth_finish')->after('auth_start')->nullable();
            $table->boolean('active')->default(true)->after('auth_finish');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table', function (Blueprint $table) {
            //
        });
    }
};
