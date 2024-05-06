<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNews extends ListRecords
{
    protected static string $resource = NewsResource::class;

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
        ];
    }
}
