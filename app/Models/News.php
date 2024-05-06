<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'category_id',
        'slug',
        'summary',
        'content',
        'status',
        'featured',
        'tags',
        'published_at',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($news) {
            $news->author_id = auth()->id() ?? User::query()->inRandomOrder()->first()->id;
            $news->slug = Str::slug($news->title);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(NewsImage::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
