<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Award extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image',
        'title',
        'slug',
        'status',
        'featured',
        'summary',
        'content',
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($award) {
            $award->author_id = auth()->id() ?? User::query()->inRandomOrder()->first()->id;
            $award->slug = Str::slug($award->title);
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
