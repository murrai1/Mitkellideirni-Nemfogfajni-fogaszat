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
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("patientid");
            $table->datetime("date");
            $table->unsignedBigInteger("dentistid");

            $table->foreign("patientid")->references("id")->on("patients")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("dentistid")->references("id")->on("dentists")->onDelete("cascade")->onUpdate("cascade");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
