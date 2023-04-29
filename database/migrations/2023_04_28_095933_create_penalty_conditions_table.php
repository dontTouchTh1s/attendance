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
        Schema::create('penalty_conditions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', \App\Enums\PenaltyConditionType::values());
            $table->integer('delay')->comment('minutes');
            $table->integer('penalty')->comment('minutes');
            $table->foreignId('group_policy_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conditions');
    }
};
