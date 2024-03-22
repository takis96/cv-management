<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;
    protected $fillable = [
        'degreeTitle',
    ];

public function candidates()
{
    return $this->hasMany(Candidate::class);
}

}
