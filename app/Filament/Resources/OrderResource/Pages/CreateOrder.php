<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Faker\Provider\ar_EG\Text;
use Filament\Actions;
use Filament\Forms\Components\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use App\Enums\OrderStatus;
use App\Filament\Resources\ProductResource;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Set;

class CreateOrder extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = OrderResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Order Created Successfully';
    }

    public function getSteps(): array
    {
        return [

            Step::make('Order Details')
                ->schema([
                    Section::make('')
                        ->schema([
                            TextInput::make('total')
                                ->hidden(),
                            TextInput::make('order_number')
                                ->readOnly()
                                ->required()
                                ->default(function () {
                                    return 'OR-' . (Order::count() + 1);
                                }),
                            Select::make('user_id')
                                ->relationship('user', 'name', function (Builder $query) {
                                    $query->where('is_admin', false);
                                })
                                ->native('false')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->createOptionForm([
                                    Section::make('Profile')
                                        ->description('Create User')
                                        ->columns([
                                            'sm' => 3,
                                            'xl' => 6,
                                            '2xl' => 8,
                                        ])
                                        ->schema([
                                            FileUpload::make('user_avatar')
                                                ->image()
                                                ->avatar()
                                                ->columnSpan([
                                                    'sm' => 3,
                                                    'xl' => 6,
                                                    '2xl' => 8,
                                                ]),
                                            TextInput::make('name')
                                                ->placeholder('John Doe')
                                                ->required()
                                                ->string()
                                                ->maxLength(20)
                                                ->minLength(3)
                                                ->columnSpan([
                                                    'sm' => 2,
                                                    'xl' => 3,
                                                    '2xl' => 4,
                                                ]),
                                            TextInput::make('email')
                                                ->placeholder('example@example.co')
                                                ->required()
                                                ->unique()
                                                ->email()
                                                ->columnSpan([
                                                    'sm' => 2,
                                                    'xl' => 3,
                                                    '2xl' => 4,
                                                ]),
                                            Select::make('role')
                                                ->placeholder('Select Role')
                                                ->searchable()
                                                ->relationship('roles', 'name',  function (Builder $query) {
                                                    $query->whereNot('name', 'super_admin');
                                                })
                                                ->preload()
                                                ->columnSpan([
                                                    'sm' => 2,
                                                    'xl' => 3,
                                                    '2xl' => 4,
                                                ]),
                                            TextInput::make('password')
                                                ->placeholder('test@1234')
                                                ->required()
                                                ->minLength(6)
                                                ->password()
                                                ->columnSpan([
                                                    'sm' => 2,
                                                    'xl' => 3,
                                                    '2xl' => 4,
                                                ]),
                                        ]),
                                ]),

                            ToggleButtons::make('status')
                                ->inline()
                                ->options(OrderStatus::class)
                                ->required(),
                        ])->columns(3),
                    Section::make('Shipping Info')
                        ->schema([
                            TextInput::make('state')
                                ->required()
                                ->label('State/Province')
                                ->placeholder('State/Province'),
                            TextInput::make('city')
                                ->required()
                                ->placeholder('City'),
                            TextInput::make('zip_code')
                                ->required()
                                ->placeholder('Zip Code'),
                            TextInput::make('address')
                                ->required()
                                ->placeholder('Address')
                                ->columnSpanFull(),

                        ])->columns(3)->collapsible(true),
                    Section::make()
                        ->schema([
                            RichEditor::make('comment')
                                ->label('Notes'),
                        ])->columnSpanFull(),
                ]),
            Step::make('Oder Items')
                ->schema([
                    Repeater::make('Items')
                        ->relationship('oderItems')
                        ->schema([
                            Select::make('product_id')
                                ->placeholder('Product')
                                ->options(Product::where([['is_visible', 1]])->pluck('name', 'id'))
                                ->searchable()
                                ->preload()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set) => $set('item_price', Product::find($state)?->price ?? 0))
                                ->distinct()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                            TextInput::make('quantity')
                                ->numeric()
                                ->required()
                                ->minValue(1)
                                ->default(1)
                                ->placeholder('Quantity')
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (?string $state, $set, Component $component) {
                                    if ($component->getName() == 'quantity') {
                                        $container = $component->getContainer();
                                        $statePatch = explode('.', $container->getStatePath());
                                        $statePatch = $statePatch[2];
                                        $data = $container->getLivewire()->data;
                                        $currentRow = in_array($statePatch, array_keys($data['Items'])) ? $data['Items'][$statePatch] : [];
                                        $product = Product::find($currentRow['product_id']);
                                        $itemTotalPrice = ($product->sale_price ?? $product->price) * ($currentRow['quantity']);
                                        $set('item_total', $itemTotalPrice);
                                    }
                                }),
                            TextInput::make('item_price')
                                ->readOnly()
                                ->required()
                                ->placeholder('Price'),
                            TextInput::make('items_total')
                                ->readOnly()
                                ->required()
                                ->placeholder('Total'),
                        ])->extraItemActions([
                            Action::make('openProduct')
                                ->tooltip('Open product')
                                ->icon('heroicon-m-arrow-top-right-on-square')
                                ->url(function (array $arguments, Repeater $component): ?string {
                                    $itemData = $component->getRawItemState($arguments['item']);

                                    $product = Product::find($itemData['product_id']);

                                    if (!$product) {
                                        return null;
                                    }

                                    return ProductResource::getUrl('edit', ['record' => $product]);
                                }, shouldOpenInNewTab: true)
                                ->hidden(fn (array $arguments, Repeater $component): bool => blank($component->getRawItemState($arguments['item'])['product_id'])),
                        ])
                        ->columns(4)

                        ->collapsible()
                        ->minItems(1),
                ])

        ];
    }
}
