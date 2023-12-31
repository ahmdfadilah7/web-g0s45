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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('kode_invoice')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pengiriman_id')->nullable();
            $table->unsignedBigInteger('rekening_id')->nullable();
            $table->string('total_invoice')->nullable();
            $table->integer('status');
            $table->integer('konfirmasi');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pengiriman_id')->references('id')->on('pengirimen')->onDelete('cascade');
            $table->foreign('rekening_id')->references('id')->on('rekenings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
