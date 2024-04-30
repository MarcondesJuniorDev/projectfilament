<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolYearResource\Pages;
use App\Filament\Resources\SchoolYearResource\RelationManagers;
use App\Models\SchoolYear;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolYearResource extends Resource
{
    protected static ?string $model = SchoolYear::class;

    protected static ?string $navigationGroup = "L M S";

    protected static ?string $modelLabel = "Ano Letivo";

    protected static ?string $pluralModelLabel = "Anos Letivos";

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $activeNavigationIcon = 'heroicon-s-calendar-days';

    public static function form(Form $form): Form
    {
        $years = range(2005, date('Y'));
        $registeredYears = SchoolYear::query()->pluck('year')->toArray();
        $availableYears = array_diff($years, $registeredYears);

        return $form
            ->schema([
                Forms\Components\Select::make('year')
                    ->label('Ano Letivo')
                    ->options(array_combine($availableYears, $availableYears))
                    ->rules(['required', 'integer', 'min:2005', 'max:' . date('Y'), 'unique:school_years,year,' . optional($form->getModel())->id])
                    ->required(),
                Forms\Components\Toggle::make('is_current')
                    ->label('Ano Letivo Atual ?')
                    ->onColor('success')
                    ->onIcon('heroicon-s-check')
                    ->offColor('danger')
                    ->offIcon('heroicon-s-x-mark')
                    ->inline(false)
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('year')
                    ->label('Anos Letivos')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Autor')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_current')
                    ->label('Ano Corrente')
                    ->onColor('success')
                    ->onIcon('heroicon-s-check')
                    ->offColor('danger')
                    ->offIcon('heroicon-s-x-mark')
                    ->inline(false),
            ])
            ->filters([
                Tables\Filters\Filter::make('Ativos')->query(
                    fn (Builder $query) => $query->where('is_current', true)
                ),
                Tables\Filters\Filter::make('Inativos')->query(
                    fn (Builder $query) => $query->where('is_current', false)
                ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchoolYears::route('/'),
            'create' => Pages\CreateSchoolYear::route('/create'),
            'edit' => Pages\EditSchoolYear::route('/{record}/edit'),
        ];
    }
}
