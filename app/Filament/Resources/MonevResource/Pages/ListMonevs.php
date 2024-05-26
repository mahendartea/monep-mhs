<?php

namespace App\Filament\Resources\MonevResource\Pages;

use App\Filament\Resources\MonevResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonevs extends ListRecords
{
    protected static string $resource = MonevResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
