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
        Schema::create('ap_ops', function (Blueprint $table) {
            $table->unsignedBigInteger("appointmentid");
            $table->unsignedBigInteger("operationid");

            $table->foreign("appointmentid")->references("id")->on("appointments")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("operationid")->references("id")->on("operations")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ap_ops');
    }
};
