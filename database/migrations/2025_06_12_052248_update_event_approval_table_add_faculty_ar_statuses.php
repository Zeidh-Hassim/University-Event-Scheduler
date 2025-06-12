<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('university_event_approvals', function (Blueprint $table) {
            $table->dropColumn('ar_status'); // Remove old column

            // Add new faculty-specific AR status columns (nullable, adjust as needed)
            $table->string('fasar_status')->nullable();
            $table->string('fbsar_status')->nullable();
            $table->string('ftsar_status')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('university_event_approvals', function (Blueprint $table) {
            // Rollback: Add the original column back
            $table->string('ar_status')->nullable();

            // Remove the new ones
            $table->dropColumn(['fasar_status', 'fbsar_status', 'ftsar_status']);
        });
    }
};
