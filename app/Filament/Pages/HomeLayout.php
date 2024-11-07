<?php

namespace App\Filament\Pages;

use App\Models\AppSettings;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\Activitylog\Models\Activity;

class HomeLayout extends Page implements HasForms
{

    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static string $view = 'filament.pages.home-layout';

    protected static ?string $navigationGroup = 'Settings';


    public ?array $data = [];

    public function mount()
    {
        $data = AppSettings::first() ? AppSettings::first()->toArray() : [];
        $this->data = $data;
        $this->form->fill($this->data);
    }

    public function save()
    {
        try {
            $data = $this->form->getState();
            dd($data);

            $activity = new Activity();
            $activity->log_name = 'App Settings';
            $activity->description = 'App Settings saved';
            $activity->event = 'Updated';
            $activity->causer_id = Auth::id();
            $activity->causer_type = Auth::user()->getMorphClass();
            $activity->properties = $data;
            $activity->save();
        } catch (Halt $exception) {
            return;
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Builder::make('Home Page Settings')
                    ->blocks([
                        Builder\Block::make('Main Banners')
                            ->schema([
                                Section::make('')
                                    ->schema([
                                        TextInput::make('title1')
                                            ->required(),
                                        TextInput::make('title2'),
                                        TextInput::make('title3'),

                                    ])->columns(2),
                            ])->columns(2),
                        Block::make('Slider Banner')
                            ->schema([
                                Section::make()
                                    ->schema([
                                        Section::make('')
                                            ->schema([
                                                FileUpload::make('image1')
                                                    ->label('Image')
                                                    ->image()
                                                    ->required(),
                                            ]),

                                        FileUpload::make('image2')
                                            ->label('Image')
                                            ->image(),
                                        FileUpload::make('image3')
                                            ->label('Image')
                                            ->image(),
                                        FileUpload::make('image4')
                                            ->label('Image')
                                            ->image(),
                                    ])->columns(2),
                            ]),
                        Block::make('Products Banner')
                            ->schema([
                                Section::make()
                                    ->schema([
                                        TextInput::make('title')
                                            ->required(),
                                        Select::make('Products')
                                            ->options(Product::all()->pluck('name', 'id'))
                                            ->searchable()
                                            ->multiple()
                                            ->native(false)
                                            ->required()
                                            ->minItems(2),
                                    ])->columns(2)
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.cancel.label'))
                ->url(filament()->getUrl())
                ->color('gray'),
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->action('save')
        ];
    }

    // protected function getFormActions(): array
    // {
    //     return [
    //         Action::make('back')
    //             ->label(__('filament-panels::resources/pages/edit-record.form.actions.cancel.label'))
    //             ->url(filament()->getUrl())
    //             ->color('gray'),
    //         Action::make('save')
    //             ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
    //             ->submit('save'),
    //     ];
    // }
}
