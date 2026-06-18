<?php

namespace App\Filament\Resources\Profiles\Pages;

use App\Filament\Resources\Profiles\ProfileResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProfile extends ViewRecord
{
    protected static string $resource = ProfileResource::class;

    public function getTitle(): string
    {
        return 'Profil';
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Ubah Profil'),
        ];
    }
}
