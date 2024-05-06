<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'news_image';

    protected $fillable = [
        'news_id',
        'image_path'
    ];

    public $timestamps = true;

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
}
