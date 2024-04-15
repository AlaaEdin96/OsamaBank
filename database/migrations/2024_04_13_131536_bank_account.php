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
        Schema::create('bank_account', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('numder_id');//الرقم الوطنى
            $table->string('id_card');// رقم الجواز
            $table->string('phone');
            $table->string('note')->nullable();
            $table->foreignId("bank_id")->constrained("bank")->cascadeOnDelete();
            $table->foreignId("client_id")->constrained("client")->cascadeOnDelete();
            $table->foreignId("creted_by_user_id")->constrained("users")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
