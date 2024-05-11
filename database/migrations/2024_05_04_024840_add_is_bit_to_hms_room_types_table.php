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
        Schema::table('hms_room_types', function (Blueprint $table) {
            //
            $table->integer('is_bit')->default(0); // Add 'is_bit' column with default value of 0

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hms_room_types', function (Blueprint $table) {
            //
                        $table->dropColumn('is_bit'); // Rollback: drop 'is_bit' column

        });
    }
};
