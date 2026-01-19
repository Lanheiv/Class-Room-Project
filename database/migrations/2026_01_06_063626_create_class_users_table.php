<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clases_id')->constrained('clases')->cascadeOnDelete();
            $table->foreignId('users_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('role')->default(0);
            $table->timestamps();

            $table->unique(['clases_id','users_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("class_users");
    }
};
