<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_pmid',
        'dob',
        'age',
        'height',
        'religion',
        'mother_tongue',
        'marital_status',
        'disability',
        'family_status',
        'family_type',
        'family_value',
        'education',
        'employed_in',
        'occupation',
        'annual_income',
        'work_location',
        'residing_state',
        'profile_image',

    ];
}
