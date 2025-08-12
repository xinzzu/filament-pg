<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->integer('height')->nullable()->comment('Height in cm');
            $table->integer('weight')->nullable()->comment('Weight in kg');
            $table->decimal('standard_blood_sugar', 5, 2)->nullable()->comment('Standard blood sugar level');
            $table->decimal('fasting_blood_sugar', 5, 2)->nullable()->comment('Fasting blood sugar level');
            $table->boolean('diabetes_mellitus_diagnosis')->default(false)->comment('Diabetes Mellitus Diagnosis');
            $table->string('other_disease')->nullable()->comment('Other diseases');
            $table->string('hba1c_results')->nullable()->comment('HbA1C examination results');
            $table->string('irs1_rs1801278')->nullable()->comment('IRS1 rs1801278 sequencing');
            $table->decimal('bmi', 5, 2)->nullable()->comment('Body Mass Index (calculated)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->dropColumn([
                'height',
                'weight',
                'standard_blood_sugar',
                'fasting_blood_sugar',
                'diabetes_mellitus_diagnosis',
                'other_disease',
                'hba1c_results',
                'irs1_rs1801278',
                'bmi',
            ]);
        });
    }
};
