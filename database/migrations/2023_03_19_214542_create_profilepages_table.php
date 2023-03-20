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
        Schema::create('profilepages', function (Blueprint $table) {
            $table->id();
            $table->Integer('user_id');
            $table->Text('bio');
            $table->String('location');
            $table->Integer('age');
            $table->String('gender');
            $table->String('interests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profilepages');
    }
};
