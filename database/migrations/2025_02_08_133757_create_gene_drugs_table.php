<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('gene_drugs', function (Blueprint $table) {
            $table->id('gene_drug_id');
            $table->unsignedBigInteger('gene_id');
            $table->unsignedBigInteger('drug_id');
            $table->text('recommendation');
            $table->timestamps();

            $table->foreign('gene_id')->references('gene_id')->on('genes')->onDelete('cascade');
            $table->foreign('drug_id')->references('drug_id')->on('drugs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('gene_drug');
    }
};
