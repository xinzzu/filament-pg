<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('full_name');

            $table->unsignedBigInteger('specialization_id');
            $table->foreign('specialization_id')
                ->references('specialization_id') // Explicitly use 'specialization_id'
                ->on('specializations')
                ->onDelete('cascade');

            $table->string('str_id')->unique();
            $table->string('practice_location');
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['specialization_id']);
            $table->dropColumn(['full_name', 'specialization_id', 'str_id', 'practice_location']);
        });
    }
};
