<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('event_category')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('status', ['publicado', 'rascunho', 'pendente'])->default('rascunho');
            $table->boolean('featured')->default(false);
            $table->text('content');
            $table->text('summary');
            $table->string('tags')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('published_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
