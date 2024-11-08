<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Carbon\Carbon;
use DateTime;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['oderItems'])->orderByDesc('id');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['order_number', 'status', 'user.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Order Number' => $record->order_number,
            'status' => $record->status,
            'name' => $record->user->name
        ];
    }

    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::where('status', 'new')->whereDate('created_at', Carbon::today())->count() > 0 ?? '';
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->label("Number")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("user.name")
                    ->label("Customer")
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('total')
                    ->state(function (Order $record) {
                        $total = 0;
                        foreach ($record->oderItems as $item) {
                            $total = $total + $item->item_total;
                        }

                        return 'Rs. ' . $total;
                    }),
                TextColumn::make('created_at')
                    ->dateTime('d-M-Y'),

            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled'
                    ])->native(false),
                SelectFilter::make('user')
                    ->relationship('user', 'name', function ($query) {
                        $query->whereIsAdmin(0);
                    })->native(false)
                    ->searchable(),
                Filter::make('created_at')->form([
                    DatePicker::make('created_from')
                        ->native(false)
                        ->placeholder('Created From')
                        ->closeOnDateSelection(),
                    DatePicker::make('created_until')
                        ->native(false)
                        ->placeholder('Created until')
                        ->closeOnDateSelection(),
                ])->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                }),

            ])->deferFilters()
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->deferLoading();
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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
