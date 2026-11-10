<?php

namespace App\Filament\Resources\Inquiries;

use App\Filament\Resources\Inquiries\Pages\ManageInquiries;
use App\Models\Inquiry;
use App\Services\InquiryWorkflowService;
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
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInboxArrowDown;

    protected static string|UnitEnum|null $navigationGroup = 'Lead Triage';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'reference';

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('inbound_inquiry_triage');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Inbound Inquiry')->schema([
                Select::make('source')->options([
                    'website' => 'Website',
                    'phone' => 'Phone',
                    'email' => 'Email',
                    'sms' => 'SMS',
                    'referral' => 'Referral',
                ])->required()->native(false),
                TextInput::make('contact_name')->required()->maxLength(255),
                TextInput::make('contact_email')->email(),
                TextInput::make('contact_phone')->tel(),
                TextInput::make('subject')->maxLength(255),
                TextInput::make('service_interest')->maxLength(255),
                Textarea::make('body')->required()->rows(5)->columnSpanFull(),
                Toggle::make('consent_email')->label('Email consent'),
                Toggle::make('consent_sms')->label('SMS consent'),
                Select::make('status')->options([
                    'new' => 'New',
                    'classified' => 'Classified',
                    'pending_approval' => 'Pending Approval',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                    'converted' => 'Converted',
                ])->native(false),
                Select::make('assigned_to')->relationship('assignee', 'name')->searchable()->preload(),
            ])->columns(2),
            Section::make('AI Classification')->schema([
                TextInput::make('ai_category')->disabled(),
                TextInput::make('ai_priority')->disabled(),
                TextInput::make('ai_score')->numeric()->disabled(),
                Textarea::make('ai_summary')->disabled()->columnSpanFull(),
            ])->columns(3)->collapsed(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference')->searchable()->sortable(),
                TextColumn::make('source')->badge(),
                TextColumn::make('contact_name')->searchable(),
                TextColumn::make('ai_category')->label('Category')->badge()->placeholder('—'),
                TextColumn::make('ai_priority')->label('Priority')->badge()
                    ->color(fn (?string $state) => match ($state) {
                        'urgent' => 'danger',
                        'high' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('ai_score')->label('Score')->sortable(),
                TextColumn::make('status')->badge()
                    ->color(fn (string $state) => match ($state) {
                        'pending_approval' => 'warning',
                        'approved', 'converted' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                IconColumn::make('consent_email')->boolean()->label('Email OK'),
                TextColumn::make('created_at')->dateTime()->since()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')->options([
                    'new' => 'New',
                    'classified' => 'Classified',
                    'pending_approval' => 'Pending Approval',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                    'converted' => 'Converted',
                ]),
                SelectFilter::make('source')->options([
                    'website' => 'Website',
                    'phone' => 'Phone',
                    'email' => 'Email',
                    'sms' => 'SMS',
                    'referral' => 'Referral',
                ]),
            ])
            ->recordActions([
                Action::make('classify')
                    ->label('AI Classify')
                    ->icon('heroicon-o-sparkles')
                    ->visible(fn (Inquiry $record) => in_array($record->status, ['new', 'classified'], true))
                    ->action(function (Inquiry $record) {
                        app(\App\Services\AiTriageService::class)->classify($record);
                        Notification::make()->title('Inquiry classified')->success()->send();
                    }),
                Action::make('approve')
                    ->label('Approve → CRM')
                    ->color('success')
                    ->icon('heroicon-o-check-badge')
                    ->visible(fn (Inquiry $record) => in_array($record->status, ['pending_approval', 'classified', 'approved'], true)
                        && ! $record->opportunity)
                    ->requiresConfirmation()
                    ->action(function (Inquiry $record) {
                        app(InquiryWorkflowService::class)->approve($record, auth()->user());
                        Notification::make()->title('Converted to CRM opportunity')->success()->send();
                    }),
                Action::make('reject')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->visible(fn (Inquiry $record) => in_array($record->status, ['pending_approval', 'classified'], true))
                    ->form([
                        Textarea::make('reason')->label('Rejection reason')->required(),
                    ])
                    ->action(function (Inquiry $record, array $data) {
                        app(InquiryWorkflowService::class)->reject($record, auth()->user(), $data['reason']);
                        Notification::make()->title('Inquiry rejected')->warning()->send();
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageInquiries::route('/'),
        ];
    }
}
