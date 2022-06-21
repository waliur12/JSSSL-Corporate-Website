<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsEducationalQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants_educational_qualifications', function (Blueprint $table) {
            $table->increments('applicants_educational_qualification_id');
            $table->foreignId('applicant_id')->constrained()->cascadeOnDelete();
            $table->string('degree')->nullable();
            $table->string('passing_year')->nullable();
            $table->string('result')->nullable();
            $table->string('institution')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants_educational_qualifications');
    }
}
