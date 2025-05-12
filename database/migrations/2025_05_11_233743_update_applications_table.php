<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
            $table->foreign('job_id')->references('id')->on('jobs_listing')->onDelete('cascade');

            $table->string('email')->after('resume_path');
            $table->string('phone')->after('email');
            $table->text('message')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone', 'message']);
            $table->dropForeign(['job_id']);
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });
    }
};
