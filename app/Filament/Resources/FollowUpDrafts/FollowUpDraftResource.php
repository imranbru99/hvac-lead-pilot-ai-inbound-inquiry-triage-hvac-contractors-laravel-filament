<?php

namespace App\Filament\Resources\FollowUpDrafts;

use App\Filament\Resources\FollowUpDrafts\Pages\ManageFollowUpDrafts;
use App\Models\FollowUpDraft;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class FollowUpDraftResource extends Resource
{
    protected static ?string $model = FollowUpDraft::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static string|UnitEnum|null $navigationGroup = 'Lead Triage';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('follow_up_drafts');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('inquiry_id')->relationship('inquiry', 'reference')->required()->searchable()->preload(),
            Select::make('channel')->options([
                'email' => 'Email',
                'sms' => 'SMS',
            ])->required(),
            TextInput::make('subject'),
            Textarea::make('body')->required()->rows(6)->columnSpanFull(),
            Select::make('status')->options([
                'draft' => 'Draft',
                'pending_approval' => 'Pending Approval',
                'approved' => 'Approved',
                'sent' => 'Sent',
                'rejected' => 'Rejected',
            ])->required(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('inquiry.reference')->label('Inquiry'),
                TextColumn::make('channel')->badge(),
                TextColumn::make('subject')->limit(40),
                TextColumn::make('status')->badge(),
                TextColumn::make('created_at')->since(),
            ])
            ->recordActions([
                Action::make('approve')
                    ->visible(fn (FollowUpDraft $record) => $record->status === 'pending_approval')
                    ->color('success')
                    ->action(function (FollowUpDraft $record) {
                        $record->update(['status' => 'approved', 'approved_at' => now()]);
                        Notification::make()->title('Follow-up approved')->success()->send();
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return ['index' => ManageFollowUpDrafts::route('/')];
    }
}
