<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'title',
        'description',
        'url',
        'isPublished',
        'isDeleted',
    ];

    /**
     * Связь Один к Одному с таблицей galleries
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

}
