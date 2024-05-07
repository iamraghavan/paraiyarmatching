<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{

    protected $table = 'photo_gallery';

    use HasFactory;

    protected $fillable = ['pmid', 'image_url'];

    public function user()
    {
        return $this->belongsTo(User::class, 'pmid', 'pmid');
    }
}