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

        Schema::create('clients', function (Blueprint $table) {
            $table->id();
             $table->string('name');
             $table->string('phone');
             $table->string('email');
             $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
             $table->string('address');
             $table->string('facebook')->nullable();
             $table->string('linkedin')->nullable();
             $table->string('instagram')->nullable();
             $table->text('note')->nullable();
             $table->tinyInteger('islead')->nullable()->default(0);
             $table->tinyInteger('status')->nullable();
             $table->text('why_status')->nullable();
             $table->softDeletes();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
