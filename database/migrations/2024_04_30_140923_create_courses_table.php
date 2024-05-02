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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('course_categories')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->text('summary');
            $table->text('description');
            $table->string('image')->nullable();
            $table->enum('status', ['publicado', 'rascunho', 'pendente'])->default('rascunho');
            $table->boolean('featured')->default(false);
            $table->boolean('featured_menu')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
