<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'event_images';

    protected $fillable = [
        'event_id',
        'image_path'
    ];

    public $timestamps = true;

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
