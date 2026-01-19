<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');
            $table->string('subject');
            $table->string('description')->nullable();
            $table->string('access_code')->unique();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists("clases");
    }
};
