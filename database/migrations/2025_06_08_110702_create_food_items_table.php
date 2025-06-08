<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('food_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('calories');
            $table->decimal('price', 10, 2);
            $table->string('category');
            $table->json('mood_tags');
            $table->json('ingredients');
            $table->string('gofood_link')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_healthy')->default(false);
            $table->integer('spicy_level')->default(0);
            $table->integer('preparation_time')->default(0);
            $table->timestamps();

            $table->index('category');
            $table->index('is_healthy');
            $table->index(['price', 'calories']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('food_items');
    }
};
