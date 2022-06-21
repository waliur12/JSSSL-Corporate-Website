<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    // protected $fillable = [
    //     'name',
    //     'contact',
    //     'email',
    //     'cv',
    // ];
    protected $guarded=[];

    public function jobApplications() {
        return $this->belongsToMany(Job::class, 'job_applicants');
    }

    public function getEducation() {
        return $this->hasMany(ApplicantsEducationalQualification::class, 'applicant_id');
    }
    public function getWork() {
        return $this->hasMany(WorkingExperience::class, 'applicant_id');
    }
}
