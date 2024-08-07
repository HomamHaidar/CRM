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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('expected_time');
            $table->integer('tax');
            $table->integer('quantity');
            $table->integer('total');
            $table->date('start');
            $table->date('end')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->text('reason')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('journey_id')->constrained();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stage_id')->nullable()->constrained()->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
