<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    use HasFactory;

    protected $table = 'photo_gallery'; // Ensure the correct table name
    protected $fillable = ['user_pmid', 'image_url'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_pmid', 'pmid');
    }
}
