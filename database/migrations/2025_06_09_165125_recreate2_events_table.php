<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Disable FK checks to allow dropping the table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('events');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->string('faculty');
            $table->date('date');
            $table->string('venue');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('participants'); // e.g., "students", "lecturers", or both
            $table->string('society');
            $table->string('applicant');
            $table->string('registration_number');
            $table->string('contact');
            $table->string('email');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

