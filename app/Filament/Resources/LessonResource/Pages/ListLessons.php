<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLessons extends ListRecords
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'todos' => ListRecords\Tab::make(),
            'publicado' => ListRecords\Tab::make()->modifyQueryUsing(function ($query) {
                $query->where('status', 'publicado');
            }),
            'rascunho' => ListRecords\Tab::make()->modifyQueryUsing(function ($query) {
                $query->where('status', 'rascunho');
            }),
            'pendente' => ListRecords\Tab::make()->modifyQueryUsing(function ($query) {
                $query->where('status', 'pendente');
            }),
            'cancelado' => ListRecords\Tab::make()->modifyQueryUsing(function ($query) {
                $query->where('status', 'pendente');
            }),
        ];
    }
}
