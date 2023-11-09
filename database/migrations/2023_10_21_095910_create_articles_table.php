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
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('article_id');

            $table->string('title');
            $table->text('description');
            $table->text('image');

            $table->unsignedBigInteger('auther_id');
            $table->foreign('auther_id')->references('auther_id')->on('authors');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories');

            $table->string('tags');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
