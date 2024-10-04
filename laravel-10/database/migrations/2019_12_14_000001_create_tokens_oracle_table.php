<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'oracle';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tokens_test', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokens_test');
    }
};
