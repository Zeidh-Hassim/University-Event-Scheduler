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
    Schema::rename('faculty_society_event_approval', 'faculty_batch_event_approval');
}

public function down()
{
    Schema::rename('faculty_batch_event_approval', 'faculty_society_event_approval');
}

};
