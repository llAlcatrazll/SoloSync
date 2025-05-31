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
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('contribution')->nullable();
            $table->integer('rage_count')->nullable();
            $table->integer('week_count')->default(now());
            $table->foreignId('id')->nullable();
            //    'contribution',
            // 'rage_count',
            // 'week_count',
            // 'id',
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};
