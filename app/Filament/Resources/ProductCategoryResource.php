<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Filament\Resources\ProductCategoryResource\Pages\CreateProductCategory;
use App\Filament\Resources\ProductCategoryResource\Pages\EditProductCategory;
use App\Filament\Resources\ProductCategoryResource\Pages\ListProductCategories;
use App\Filament\Resources\ProductCategoryResource\RelationManagers;
use App\Models\ProductCategory;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationParentItem = 'Products';

    protected static ?string $navigationLabel = 'Categories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Categories')
                    ->description('Update your category details and slug.')
                    ->schema([
                        Hidden::make('created_by')->default(auth()->user()->id),
                        TextInput::make('name')
                            ->required()
                            ->minLength(3)
                            ->maxLength(150)
                            ->placeholder('Category name')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, ?string $state, $set) {
                                $operation == 'create' ?  $set('slug', str($state)->slug()->toString()) : '';
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('Category Slug')
                            ->minLength(3)
                            ->maxLength(150)
                            ->readOnly(),
                        Select::make('parent_id')
                            ->options(ProductCategory::where('parent_id', null)->where('status', 1)->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->native(false),
                        Select::make('status')
                            ->native(false)
                            ->label('Status')
                            ->required()
                            ->options([
                                '1' => 'Active',
                                '0' => 'Inactive',
                            ]),
                        TextInput::make('description')
                            ->placeholder('Description')
                            ->maxLength(150),
                        FileUpload::make('image')
                            ->label('Image')
                            ->disk('public')
                            ->directory('web/categories'),
                    ])->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2,
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug'),
                TextColumn::make('description')
                    ->state(function (ProductCategory $record) {
                        if ($record->description == null) {
                            return '-';
                        }

                        return strlen($record->description) > 50
                            ? substr($record->description, 0, 50) . '...'
                            : $record->description;
                    }),
                TextColumn::make('parent.name')
                    ->state(function (ProductCategory $record) {
                        if ($record->parent == null) {
                            return '-';
                        }

                        return $record->parent->name;
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProductCategories::route('/'),
            // 'create' => Pages\CreateProductCategory::route('/create'),
            // 'edit' => Pages\EditProductCategory::route('/{record}/edit'),
        ];
    }
}
