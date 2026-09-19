<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Sparc\Vacancies\Enums\ApplicationStatus as Status;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->constrained('vacancies')->cascadeOnDelete();
            $table->string('name');
            $table->string('gender');
            $table->string('bio');
            $table->string('email');
            $table->string('status')->default(Status::PENDING_SCORE);
            $table->integer('score')->nullable();
            $table->text('remarks')->nullable();
            $table->date('date_of_birth');
            $table->timestamps();

            $table->index('vacancy_id');
            $table->unique(['vacancy_id', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
