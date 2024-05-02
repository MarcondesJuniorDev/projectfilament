<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'lesson_id',
        'title',
        'description',
        'is_main',
        'is_file',
        'content_type',
        'content_value',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($lesson) {
            $lesson->author_id = auth()->id() ?? User::factory()->create()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
