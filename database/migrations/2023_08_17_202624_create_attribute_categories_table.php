<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attribute_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->boolean('is_multiple')->default(false);
            $table->boolean('keyword')->default(false);
            $table->boolean('required_for_organization')->default(false);
            $table->boolean('form_name')->default(false);
            $table->boolean('for_seo')->nullable()->default(false);
            $table->integer('position')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attribute_categories');
    }
};
