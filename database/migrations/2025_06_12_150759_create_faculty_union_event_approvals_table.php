<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyUnionEventApprovalsTable extends Migration
{
    public function up(): void
    {
        Schema::create('faculty_union_event_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            
            $table->string('fasar_status')->nullable();
            $table->string('fbsar_status')->nullable();
            $table->string('ftsar_status')->nullable();
            $table->string('fasdp_status')->nullable();
            $table->string('fbsdp_status')->nullable();
            $table->string('ftsdp_status')->nullable();
            $table->string('marshall_status')->nullable();
            $table->string('fasdean_status')->nullable();
            $table->string('fbsdean_status')->nullable();
            $table->string('ftsdean_status')->nullable();
            $table->string('final_status')->nullable();

            $table->timestamps();

            // Foreign key to events table
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faculty_union_event_approvals');
    }
}
