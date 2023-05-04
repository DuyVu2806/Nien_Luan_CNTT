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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->integer('rating');
            $table->text('outstanding_feature')->nullable()->default('');
            $table->text('transportation')->nullable()->default('');
            $table->text('comment')->nullable()->default('');
            $table->bigInteger('order_item_id')->unsigned();
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
