<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;
use Illuminate\Support\Number;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Pesanan';
    protected static ?string $label = 'Pesanan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Pesanan')->schema([
                TextInput::make('checkout.user.name')
                    ->label('Nama Pembeli')
                    ->disabled(),

                TextInput::make('product.nama_produk')
                    ->label('Produk')
                    ->disabled(),

                TextInput::make('price')
                    ->label('Harga')
                    ->numeric()
                    ->disabled(),

                TextInput::make('quantity')
                    ->label('Jumlah')
                    ->numeric()
                    ->disabled(),

                Select::make('shipment_status')
                    ->label('Status Pengiriman')
                    ->options([
                        'Dikemas' => 'Dikemas',
                        'Dikirim' => 'Dikirim',
                        'Selesai' => 'Selesai',
                        'Dibatalkan' => 'Dibatalkan',
                    ])
                    ->required(),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('checkout.user.name')
                ->label('Nama Pembeli')
                ->searchable(),

            TextColumn::make('product.nama_produk')
                ->label('Produk'),

            TextColumn::make('price')
                ->label('Harga')
                ->money('IDR'),

            TextColumn::make('quantity')
                ->label('Jumlah'),

            TextColumn::make('shipment_status')
                ->label('Status Pengiriman')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'Dikemas' => 'warning',
                    'Dikirim' => 'info',
                    'Selesai' => 'success',
                    'Dibatalkan' => 'danger',
                    default => 'gray',
                }),

            TextColumn::make('created_at')
                ->label('Tanggal Order')
                ->dateTime('d M Y H:i'),
            ])
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
