<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Comment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CommentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CommentResource\RelationManagers;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationLabel = 'Komentar';

    protected static ?string $label = 'Komentar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Komentar')->schema([

                    Select::make('user_id')
                        ->label('User')
                        ->relationship('user', 'name')
                        ->disabled(),

                    Select::make('product_id')
                        ->label('Produk')
                        ->relationship('product', 'name')
                        ->disabled(),

                    Textarea::make('comment_text')
                        ->label('Komentar')
                        ->columnSpanFull()
                        ->disabled(),

                    TextInput::make('rating')
                        ->label('Rating')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(5)
                        ->disabled(),

                    Textarea::make('admin_feedback')
                        ->label('Berikan Feedback')
                        ->columnSpanFull()
                        ->nullable(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),

                TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable(),

                TextColumn::make('comment_text')
                    ->label('Komentar')
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('admin_feedback')
                    ->label('Feedback Admin')
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->badge()
                    ->colors([
                        'danger' => 1,
                        'warning' => 2,
                        'yellow' => 3,
                        'info' => 4,
                        'success' => 5,
                    ])
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
