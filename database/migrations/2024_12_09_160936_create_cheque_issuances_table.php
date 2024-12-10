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
        Schema::create('cheque_issuances', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');  // Name of the business
            $table->string('bank');  // The name of the bank
            $table->string('cheque_number');  // Last 4 digits of the cheque number
            $table->text('remarks')->nullable();  // Remarks (nullable)
            $table->timestamps();  // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cheque_issuances');
    }
};
