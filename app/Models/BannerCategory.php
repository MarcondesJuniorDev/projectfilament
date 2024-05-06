<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BannerCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'order',
        'name',
        'slug'
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(static function ($bannerCategory) {
            $originalSlug = Str::slug($bannerCategory->name);
            $slug = $originalSlug;
            $count = 1;

            while (BannerCategory::query()->where('slug', $slug)->exists()) {
                $slug = "{$originalSlug}-" . $count++;
            }

            $bannerCategory->slug = $slug;
        });

        static::deleting(function($bannerCategory) {
            if ($bannerCategory->banners()->count() > 0 || $bannerCategory->children()->count() > 0) {
                Notification::make()
                    ->title('Erro ao excluir categoria')
                    ->body('Não é possível excluir uma categoria que possui banners vinculados.')
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
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class, 'category_id', 'id');
    }
}
