<?php

namespace App\Filament\Resources\Opportunities;

use App\Filament\Resources\Opportunities\Pages\ManageOpportunities;
use App\Models\Opportunity;
use App\Services\ModuleManager;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class OpportunityResource extends Resource
{
    protected static ?string $model = Opportunity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static string|UnitEnum|null $navigationGroup = 'Sales CRM';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        return app(ModuleManager::class)->enabled('crm_opportunities');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required()->columnSpanFull(),
            Select::make('inquiry_id')->relationship('inquiry', 'reference')->searchable()->preload(),
            Select::make('customer_id')->relationship('customer', 'name')->searchable()->preload(),
            Select::make('owner_id')->relationship('owner', 'name')->searchable()->preload(),
            Select::make('stage')->options([
                'qualified' => 'Qualified',
                'proposal' => 'Proposal',
                'negotiation' => 'Negotiation',
                'won' => 'Won',
                'lost' => 'Lost',
            ])->required(),
            TextInput::make('value_estimate')->numeric()->prefix('$'),
            TextInput::make('probability')->numeric()->minValue(0)->maxValue(100)->suffix('%'),
            Select::make('status')->options([
                'open' => 'Open',
                'won' => 'Won',
                'lost' => 'Lost',
                'on_hold' => 'On Hold',
            ])->required(),
            Textarea::make('notes')->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->limit(40),
                TextColumn::make('stage')->badge(),
                TextColumn::make('value_estimate')->money('USD')->sortable(),
                TextColumn::make('probability')->suffix('%')->sortable(),
                TextColumn::make('status')->badge(),
                TextColumn::make('owner.name')->label('Owner'),
                TextColumn::make('created_at')->since(),
            ])
            ->recordActions([
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
            'index' => ManageOpportunities::route('/'),
        ];
    }
}
