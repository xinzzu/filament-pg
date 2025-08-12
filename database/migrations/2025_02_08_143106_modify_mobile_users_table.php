<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('mobile_users', function (Blueprint $table) {
            // Add patient_id as a foreign key referencing patient_id in patients table
            $table->unsignedBigInteger('patient_id')->after('id');
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('mobile_users', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
            $table->dropColumn('patient_id');
        });
    }
};
