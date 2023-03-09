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
        Schema::create('assistants', function (Blueprint $table) {
            $table->id();
            $table->integer("dentistid");
            $table->string("name");
            $table->integer("accountid");

            $table->foreign("accountid")->references("id")->on("accounts")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("dentistid")->references("id")->on("dentists")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistants');
    }
};
