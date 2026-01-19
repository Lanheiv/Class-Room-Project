<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('clases')->cascadeOnDelete();
            $table->string('title_name');
            $table->string('description')->nullable();
            $table->timestamp('time_for_task')->nullable();
            $table->integer('max_points')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("tasks");
    }
};
