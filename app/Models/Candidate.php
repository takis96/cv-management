<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'lastName',
        'firstName',
        'email',
        'mobile',
        'degree',
        'resume',
        'jobAppliedFor',
        'applicationDate',
    ];

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

}
