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
        Schema::create('coloring_data_row', function (Blueprint $table) {
            $table->id();
            $table
                ->foreign('data_details_id')
                ->references('id')
                ->on('data_details');
            $table->string('header');
            $table->string('color_row');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coloring_data_row');
    }
};
