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
        Schema::create('track_genre', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('track_id');
            $table->foreign('track_id')->references('id')->on('tracks');
            $table->unsignedBigInteger('genre_id');
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_genre');
    }
};
