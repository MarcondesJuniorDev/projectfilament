<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'image',
        'url',
        'status'
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(static function ($banner) {
            $banner->slug = Str::slug($banner->title);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BannerCategory::class, 'category_id', 'id');
    }
}
