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
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('word')->comment('The word itself');
            $table->string('guide_word')->nullable()->comment('A word that helps to find the word in a dictionary');
            $table->string('level')->comment('A1, A2, B1, B2, C1, C2');
            $table->string('type')->nullable()->comment('noun, verb, adjective, adverb, etc.');
            $table->string('status')->nullable()->comment("I know, I don't know, etc.");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};
