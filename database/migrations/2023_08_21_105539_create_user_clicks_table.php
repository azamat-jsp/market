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
        Schema::create('user_clicks', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('clickable_type');
            $table->unsignedBigInteger('clickable_id');
            $table->foreignId('identifier_id')->nullable()->constrained('user_identifiers');
            $table->timestamps();

            $table->index(['clickable_type', 'clickable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clicks');
    }
};
