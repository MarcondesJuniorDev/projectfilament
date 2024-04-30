<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['author_id', 'category_id', 'title', 'slug', 'summary', 'description', 'image', 'status', 'featured', 'featured_menu'];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($course) {
            $course->slug = Str::slug($course->title);
            $course->author_id = auth()->id() ?? User::factory()->create()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }
}
