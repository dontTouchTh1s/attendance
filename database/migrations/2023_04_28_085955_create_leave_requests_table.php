<?php

use App\Enums\LeaveRequestsType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->enum('type', LeaveRequestsType::values());
            $table->dateTime('from_date');
            $table->dateTime('to_date');
            $table->time('from_hour')->default('07:00:00');
            $table->time('to_hour')->default('15:00:00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
