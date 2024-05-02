<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationGroup = "L M S";

    protected static ?string $modelLabel = "Aula";

    protected static ?string $pluralModelLabel = "Aulas";

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $activeNavigationIcon = 'heroicon-s-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Capa do Curso')
                    ->columnSpanFull()
                    ->image(),
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->label('Código Único')
                    ->mask('aaa9999')
                    ->placeholder('Ex: MAT1234')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'rascunho' => 'Rascunho',
                        'publicado' => 'Publicado',
                        'pendente' => 'Pendente',
                        'cancelado' => 'Cancelado',
                    ])
                    ->required(),
                Forms\Components\Select::make('school_grade_id')
                    ->label('Série')
                    ->relationship('schoolGrade', 'title')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('subject_id')
                    ->label('Componente')
                    ->relationship('subject', 'title')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('course_id')
                    ->label('Curso')
                    ->relationship('course', 'title')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('school_year_id')
                    ->label('Ano Letivo')
                    ->relationship('schoolYear', 'year')
                    ->required(),
                Forms\Components\TagsInput::make('tags')
                    ->label('Tags')
                    ->separator(',')
                    ->splitKeys(['Tab', 'Enter', ',', ' '])
                    ->reorderable()
                    ->color('primary')
                    ->nestedRecursiveRules([
                        'min:3',
                        'max:255',
                    ])
                    ->placeholder('Adicione tags para facilitar a busca'),
                Forms\Components\DatePicker::make('lesson_date')
                    ->label('Data da Aula')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Descrição')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Capa'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('code')
                    ->label('Código Único')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Autor')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('schoolGrade.title')
                    ->label('Série')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('subject.title')
                    ->label('Componente')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('course.title')
                    ->label('Curso')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('schoolYear.year')
                    ->label('Ano Letivo')
                    ->numeric('0', '', '')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (Lesson $lesson) => match ($lesson->status) {
                        'rascunho' => 'info',
                        'publicado' => 'success',
                        'pendente' => 'warning',
                        'cancelado' => 'danger',
                    })
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('tags')
                    ->label('Tags')
                    ->badge(fn(Lesson $lesson) => explode(',', $lesson->tags))
                    ->color('primary')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('lesson_date')
                    ->label('Data da Aula')
                    ->date('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('author')
                    ->label('Autor')
                    ->searchable()
                    ->relationship('author', 'name'),
                Tables\Filters\SelectFilter::make('school_grade')
                    ->label('Série')
                    ->searchable()
                    ->relationship('schoolGrade', 'title'),
                Tables\Filters\SelectFilter::make('subject')
                    ->label('Componente')
                    ->searchable()
                    ->relationship('subject', 'title'),
                Tables\Filters\SelectFilter::make('course')
                    ->label('Curso')
                    ->searchable()
                    ->relationship('course', 'title'),
                Tables\Filters\SelectFilter::make('school_year')
                    ->label('Ano Letivo')
                    ->searchable()
                    ->relationship('schoolYear', 'year'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until')
                            ->default(now()),
                    ])
            ], FiltersLayout::Modal)
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
            RelationManagers\ContentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
