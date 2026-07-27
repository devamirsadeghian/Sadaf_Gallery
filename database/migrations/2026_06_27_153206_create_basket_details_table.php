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
        Schema::create('basket_details', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default(\App\Enums\BasketDetailsStatus::processing->value);
            $table->unsignedBigInteger('basket_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable()->nullOnDelete();
            $table->integer('count')->default(null);
            $table->bigInteger('price')->default(null);
            $table->bigInteger('discount')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basket_details');
    }
};
