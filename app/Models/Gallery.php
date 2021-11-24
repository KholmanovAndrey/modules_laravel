<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'title',
        'description',
        'isPublished',
        'isDeleted',
    ];

    /**
     * Связь Один ко Многим с таблицей gallery_images
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_id', 'id');
    }

}
