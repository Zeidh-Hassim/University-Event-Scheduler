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
    Schema::table('faculty_union_event_approvals', function (Blueprint $table) {
        $table->enum('fasar_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null)->change();
        $table->enum('fbsar_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null)->change();
        $table->enum('ftsar_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null)->change();
        $table->enum('fasdp_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null)->change();
        $table->enum('fbsdp_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null)->change();
        $table->enum('ftsdp_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null)->change();
        $table->enum('marshall_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null)->change();
        $table->enum('fasdean_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null)->change();
        $table->enum('fbsdean_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null)->change();
        $table->enum('ftsdean_status', ['Pending', 'Approved', 'Rejected'])->nullable()->default(null)->change();
        $table->enum('final_status', ['Pending', 'Approved', 'Rejected'])->default('Pending')->change();
    });
}

public function down(): void
{
    Schema::table('faculty_union_event_approvals', function (Blueprint $table) {
        $table->string('fasar_status')->nullable()->change();
        $table->string('fbsar_status')->nullable()->change();
        $table->string('ftsar_status')->nullable()->change();
        $table->string('fasdp_status')->nullable()->change();
        $table->string('fbsdp_status')->nullable()->change();
        $table->string('ftsdp_status')->nullable()->change();
        $table->string('marshall_status')->nullable()->change();
        $table->string('fasdean_status')->nullable()->change();
        $table->string('fbsdean_status')->nullable()->change();
        $table->string('ftsdean_status')->nullable()->change();
        $table->string('final_status')->default('Pending')->change();
    });
}

};
