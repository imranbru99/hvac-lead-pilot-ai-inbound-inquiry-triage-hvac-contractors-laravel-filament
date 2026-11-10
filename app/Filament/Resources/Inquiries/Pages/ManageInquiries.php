<?php

namespace App\Filament\Resources\Inquiries\Pages;

use App\Filament\Resources\Inquiries\InquiryResource;
use App\Services\InquiryWorkflowService;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageInquiries extends ManageRecords
{
    protected static string $resource = InquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('quickIntake')
                ->label('Quick Intake + AI')
                ->icon('heroicon-o-bolt')
                ->form([
                    Select::make('source')->options([
                        'website' => 'Website',
                        'phone' => 'Phone',
                        'email' => 'Email',
                        'sms' => 'SMS',
                        'referral' => 'Referral',
                    ])->required()->default('website'),
                    TextInput::make('contact_name')->required(),
                    TextInput::make('contact_email')->email(),
                    TextInput::make('contact_phone'),
                    TextInput::make('subject'),
                    TextInput::make('service_interest'),
                    Textarea::make('body')->required()->rows(4),
                    Toggle::make('consent_email')->default(true),
                    Toggle::make('consent_sms')->default(false),
                ])
                ->action(function (array $data) {
                    $inquiry = app(InquiryWorkflowService::class)->intake($data, auth()->user());
                    Notification::make()
                        ->title('Inquiry ingested')
                        ->body("{$inquiry->reference} scored {$inquiry->ai_score} ({$inquiry->ai_category})")
                        ->success()
                        ->send();
                }),
            CreateAction::make(),
        ];
    }
}
