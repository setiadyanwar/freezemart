<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Chats extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left';

    protected static string $view = 'filament.pages.chats';

    protected static ?string $navigationLabel = 'Pesan';

    public function getTitle(): string
    {
        return '';
    }
}
