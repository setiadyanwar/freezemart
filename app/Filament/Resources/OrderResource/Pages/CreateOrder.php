<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Hitung total harga sebelum disimpan
        $data['price_total'] = collect($data['items'] ?? [])
            ->sum(fn ($item) => $item['total_amount'] ?? 0);

        return $data;
    }
}
