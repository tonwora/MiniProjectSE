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
        Schema::create('work_statuses', function (Blueprint $table) {
            $table->unsignedBigInteger('work_id');
            $table->unsignedBigInteger('user_id');
            $table->string('std');
            $table->string('name');
            $table->integer('point');
            $table->string('date_process');
            $table->timestamps();
            $table->foreign('work_id')->references('work_id')->on('works');
            $table->foreign('user_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_statuses');
    }
};
