<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   return new class extends Migration
   {
       public function up(): void
       {
           Schema::create('candidate_profiles', function (Blueprint $table) {
               $table->id();
               $table->foreignId('user_id')->constrained()->onDelete('cascade');
               $table->string('resume')->nullable();
               $table->text('skills')->nullable();
               $table->timestamps();
           });
       }

       public function down(): void
       {
           Schema::dropIfExists('candidate_profiles');
       }
   };