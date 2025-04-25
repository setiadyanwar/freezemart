<?php

namespace App\Filament\Resources;

use App\Models\Faq;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FaqResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FaqResource\RelationManagers;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'FAQ';

    protected static ?string $label = 'FAQ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('pertanyaan')  // Mengubah 'question' menjadi 'pertanyaan'
                    ->label('Pertanyaan')
                    ->columnSpan(2) // Membuat form lebih lebar
                    ->maxLength(255), // Menambah batas panjang teks jika perlu

                MarkdownEditor::make('jawaban')  // Mengubah 'answer' menjadi 'jawaban'
                    ->label('Jawaban')
                    ->columnSpan(2)
                    ->maxLength(2000), // Mengizinkan resizing vertikal
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pertanyaan')
                    ->label('Pertanyaan')
                    ->wrap() 
                        ->extraAttributes([
                            'style' => 'max-height: 100px; overflow-y: auto; white-space: normal; word-break: break-word; width: 400px;' ]),

                TextColumn::make('jawaban')
                    ->label('Jawaban')
                    ->wrap()
                        ->extraAttributes([
                            'style' => 'max-height: 100px; overflow-y: auto; white-space: normal; word-break: break-word; width: 400px;']),

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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
