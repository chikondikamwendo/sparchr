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
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->morphs('qualificationable');
            $table->string('field');
            $table->string('level');
            $table->string('institution')->nullable();
            $table->text('description')->nullable();
            $table->boolean('required')->nullable();
            $table->year('year')->nullable();
            $table->timestamps();

            $table->index('vacancy_id');
            $table->index('field');
            $table->index('level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qualifications');
    }
};
