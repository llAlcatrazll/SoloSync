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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('username')->nullable();
            $table->string('guild_attribution')->nullable();
            $table->string('role')->default('member');
            $table->string('battle_tier')->nullable();
            $table->string('permission')->default('none');
            $table->string('status')->default('active');
            // $table->string('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
