<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'title',
        'location',
        'short_description',
        'description',
        'deadline',
        'precedence',        
        'package_no',
        // 'admit_card',
    ];
    protected $dates = [
        'deadline',
    ];

    public function requirements() {
        return $this->belongsToMany(Requirement::class, 'job_requirements');
    }

    public function responsibilities() {
        return $this->belongsToMany(Responsibility::class, 'job_responsibilities');
    }
    public function instruction() {
        return $this->belongsToMany(Instruction::class, 'job_instructions');
    }
    public function applicants() {
        return $this->belongsToMany(Applicant::class, 'job_applicants')
        ->where('is_visible',0)
        ->orderBy('id','DESC');
    }
}
