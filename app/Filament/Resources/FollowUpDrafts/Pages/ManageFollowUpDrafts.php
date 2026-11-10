<?php

namespace App\Filament\Resources\FollowUpDrafts\Pages;

use App\Filament\Resources\FollowUpDrafts\FollowUpDraftResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageFollowUpDrafts extends ManageRecords
{
    protected static string $resource = FollowUpDraftResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
