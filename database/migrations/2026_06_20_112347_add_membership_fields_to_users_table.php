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
            Schema::table('users', function (Blueprint $table) {
         
         $table->string('membership_level')->default('Bronze');
        
        
            $table->timestamp('membership_expired_at')->nullable();
    });
    }

    public function down()
    {
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('membership_level');
        $table->dropColumn('membership_expired_at');
    });
}
};