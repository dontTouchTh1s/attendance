<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('group_policies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('max_leave_month')->comment('minutes');
            $table->integer('max_leave_year')->comment('minutes');
            $table->foreignId('work_place_id')->constrained();
            $table->time('work_start_hour');
            $table->time('work_end_hour');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_policies');
    }
};
