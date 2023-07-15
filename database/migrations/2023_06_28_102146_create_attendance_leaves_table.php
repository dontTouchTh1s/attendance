<?php

use App\Enums\AttendanceLeaveType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendance_leaves', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date');
            $table->enum('type', AttendanceLeaveType::values());
            $table->foreignId('employee_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_leave_times');
    }
};
