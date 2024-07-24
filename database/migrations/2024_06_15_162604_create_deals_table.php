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
            $table->tinyInteger('status')->default(0);
            $table->text('reason')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('client_id')->constrained();

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
