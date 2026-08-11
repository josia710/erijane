<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('badge')->nullable();
            $table->string('tone', 32)->default('mint');
            $table->unsignedTinyInteger('weeks')->default(1);
            $table->string('level', 32)->default('Beginner');
            $table->string('focus', 64)->default('Full Body');
            $table->string('image')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('date_label')->nullable();
            $table->string('duration', 32)->nullable();
            $table->string('category', 64)->nullable();
            $table->string('image')->nullable();
            $table->string('external_url')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('category', 64)->nullable();
            $table->string('time', 32)->nullable();
            $table->string('tone', 32)->default('peach');
            $table->string('image')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->unsignedInteger('price')->default(0);
            $table->string('category', 64)->default('Apparel');
            $table->string('tone', 32)->default('sky');
            $table->string('image')->nullable();
            $table->string('line', 32)->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('recipes');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('programs');
    }
};
