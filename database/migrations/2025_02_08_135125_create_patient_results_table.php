<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('patient_results', function (Blueprint $table) {
            $table->id('patient_result_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('gene_id');
            $table->string('status');
            $table->timestamps();


            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
            $table->foreign('gene_id')->references('gene_id')->on('genes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('patient_results');
    }
};
