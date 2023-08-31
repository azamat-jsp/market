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
        Schema::create('user_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('viewable_type');
            $table->unsignedBigInteger('viewable_id');
            $table->foreignId('identifier_id')->nullable()->constrained('user_identifiers');
            $table->timestamps();

            $table->unique(['identifier_id', 'viewable_id', 'viewable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
