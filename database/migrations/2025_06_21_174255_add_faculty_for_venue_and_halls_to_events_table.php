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
    Schema::table('events', function (Blueprint $table) {
        $table->string('faculty_for_venue')->nullable(); 
        $table->string('halls')->nullable();  
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
        $table->dropColumn(['faculty_for_venue', 'halls']);
    });
    }
};
