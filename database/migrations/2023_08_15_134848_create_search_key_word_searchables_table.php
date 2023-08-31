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
        Schema::create('search_key_word_searchables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('search_key_word_id')->references('id')->on('search_key_words')->cascadeOnDelete();
            $table->morphs('key_word');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_key_word_searchables');
    }
};
