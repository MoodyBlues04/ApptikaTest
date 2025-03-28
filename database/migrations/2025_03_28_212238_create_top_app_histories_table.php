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
        Schema::create('top_app_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('app_id');
            $table->date('date');
            $table->unsignedInteger('position');
            $table->timestamps();

            $table->unique(['category_id', 'app_id', 'date', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_app_histories');
    }
};
