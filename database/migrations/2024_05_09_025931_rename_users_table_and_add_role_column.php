<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::rename('users', 'admins');

        Schema::table('admins', function (Blueprint $table) {
            $table->string('role')->default('admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::rename('admins', 'users');
    }

    
};
