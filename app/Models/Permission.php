<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($permission) {
            $permission->slug = Str::slug($permission->name);
        });

        static::deleting(function($permission) {
            if ($permission->roles()->count() > 0) {
                Notification::make()
                    ->title('Erro ao excluir permissão')
                    ->body('Não é possível excluir uma permissão que possui funções vinculadas.')
                    ->color('danger')
                    ->icon('heroicon-s-x-circle')
                    ->iconColor('danger')
                    ->status('error')
                    ->duration(5000)
                    ->inline()
                    ->send();

                return false;
            }
        });
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
