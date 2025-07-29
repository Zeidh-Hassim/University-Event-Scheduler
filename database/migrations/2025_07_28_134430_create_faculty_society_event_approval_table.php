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
    Schema::create('faculty_society_event_approval', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('event_id');
        
        $table->string('fasar_status')->nullable();
        $table->string('fbsar_status')->nullable();
        $table->string('ftsar_status')->nullable();
        
        $table->string('fashod_status')->nullable();
        $table->string('fbshod_status')->nullable();
        $table->string('ftshod_status')->nullable();

        $table->string('fasdean_status')->nullable();
        $table->string('fbsdean_status')->nullable();
        $table->string('ftsdean_status')->nullable();
        
        $table->string('final_status')->nullable();
        $table->text('rejection_reason')->nullable();
        
        $table->timestamps();

        // If you have an events table, you can link the foreign key like this:
        // $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_society_event_approval');
    }
};


