<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class NewsCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'news_category';

    protected $fillable = [
        'parent_id',
        'order',
        'name',
        'slug',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($newsCategory) {
            $newsCategory->slug = Str::slug($newsCategory->name);
        });

        static::deleting(function($newsCategory) {
            if ($newsCategory->news()->count() > 0 || $newsCategory->children()->count() > 0) {
                Notification::make()
                    ->title('Erro ao excluir categoria')
                    ->body('Não é possível excluir uma categoria que possui notícias vinculadas.')
                    ->color('danger')
                    ->icon('heroicon-s-x-circle')
                    ->iconColor('danger')
                    ->status('error')
                    ->duration(5000)
                    ->inline()
                    ->send();

                return false;
            }

            return true;
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'category_id');
    }
}
