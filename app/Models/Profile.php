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
        'horoscope_url',
        'my_bio',
        'number_of_siblings',
        'siblings',
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'star',
        'raasi',
        'dosham',
        'diet',
        'birth_place',
        'birth_time',

    ];

    protected $casts = [
        'siblings' => 'array',
    ];

    public function photo_gallery()
    {
        return $this->hasMany(PhotoGallery::class, 'user_pmid', 'user_pmid');
    }
}