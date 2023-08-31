<?php

use App\Tbuy\Category\Enums\CategoryStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->foreignId('parent_id')->nullable();
            $table->integer('position')->nullable();
            $table->boolean('is_active')->default(false);
            $table->unsignedTinyInteger('min_images')->nullable();
            $table->boolean('form_description')->default(false);
            $table->boolean('offer_services')->default(false);
            $table->json('description')->nullable();
            $table->string('status')->default(CategoryStatus::ACTIVE->value);
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
