<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('university_event_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $table->enum('ar_status', ['Pending', 'Approved', 'Rejected'])->default('Pending');

            // Nullable, default null
            $table->enum('marshall_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null);
            $table->enum('proctor_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null);
            $table->enum('vc_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null);

            $table->enum('final_status', ['Pending', 'Approved', 'Rejected'])->default('Pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_event_approvals');
    }
};
