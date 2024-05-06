<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'status',
        'featured',
        'content',
        'summary',
        'tags',
        'start_date',
        'end_date',
        'published_date',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'published_date',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'tags' => 'array',
    ];
    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($event) {
            $event->author_id = auth()->id() ?? User::query()->inRandomOrder()->first()->id;
            $event->slug = Str::slug($event->title);
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(EventImage::class);
    }
}
