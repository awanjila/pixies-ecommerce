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
        Schema::create('gas_issuings', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('gas_type')->nullable();
            $table->date('date');
            $table->string('issuing_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gas_issuings');
    }
};
