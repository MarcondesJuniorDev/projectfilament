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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('school_grade_id');
            $table->foreign('school_grade_id')->references('id')->on('school_grades')->cascadeOnDelete();
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->cascadeOnDelete();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->cascadeOnDelete();
            $table->unsignedBigInteger('school_year_id');
            $table->foreign('school_year_id')->references('id')->on('school_years')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('code');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['publicado', 'rascunho', 'pendente', 'cancelado'])->default('rascunho');
            $table->string('tags')->nullable();
            $table->date('lesson_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
