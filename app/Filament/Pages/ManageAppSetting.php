<?php

namespace App\Filament\Pages;

use App\Models\AppSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * @property-read Schema $form
 */
class ManageAppSetting extends Page
{
    protected string $view = 'filament.pages.manage-app-setting';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|\UnitEnum|null $navigationGroup = 'System Settings';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'App Settings';

    protected static ?string $title = 'App Settings';

    public static function canAccess(): bool
    {
        return auth()->user()?->can('view-any app-settings') ?? false;
    }

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $record = $this->getRecord();
        $this->form->fill($record ? $record->attributesToArray() : []);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    Tabs::make('App Settings')
                        ->tabs([
                            Tab::make('General Info')
                                ->schema([
                                    TextInput::make('app_name')
                                        ->required()
                                        ->default('UNIMO'),
                                    TextInput::make('email')
                                        ->label('Email Hubungi Kami')
                                        ->email()
                                        ->default(null),
                                    TextInput::make('ga4_measurement_id')
                                        ->label('Google Analytics GA4 ID')
                                        ->default(null),
                                    Toggle::make('spmb_open')
                                        ->label('Buka Pendaftaran SPMB')
                                        ->default(true),
                                    Toggle::make('graduation_list_published')
                                        ->label('Publikasikan List Kelulusan')
                                        ->default(true),
                                    TextInput::make('max_test_questions')
                                        ->label('Maksimal Soal Ujian')
                                        ->numeric()
                                        ->default(10)
                                        ->required(),
                                    Textarea::make('app_description')
                                        ->default(null)
                                        ->columnSpanFull(),
                                ])
                                ->columns(3),

                            Tab::make('App Media')
                                ->schema([
                                    FileUpload::make('logo')
                                        ->image()
                                        ->disk('public')
                                        ->directory('settings')
                                        ->getUploadedFileNameForStorageUsing(fn ($file) => time().'_'.str()->random(5).'.'.$file->getClientOriginalExtension())
                                        ->default(null),
                                    FileUpload::make('favicon')
                                        ->image()
                                        ->disk('public')
                                        ->directory('settings')
                                        ->getUploadedFileNameForStorageUsing(fn ($file) => time().'_'.str()->random(5).'.'.$file->getClientOriginalExtension())
                                        ->default(null),
                                    FileUpload::make('default_share_image')
                                        ->image()
                                        ->disk('public')
                                        ->directory('settings')
                                        ->getUploadedFileNameForStorageUsing(fn ($file) => time().'_'.str()->random(5).'.'.$file->getClientOriginalExtension())
                                        ->default(null),
                                ])
                                ->columns(3),

                            Tab::make('SEO Metadata')
                                ->schema([
                                    TextInput::make('meta_title_default')
                                        ->label('Default Meta Title')
                                        ->default(null),
                                    TextInput::make('meta_keywords')
                                        ->label('Default Meta Keywords')
                                        ->default(null),
                                    Textarea::make('meta_description_default')
                                        ->label('Default Meta Description')
                                        ->default(null)
                                        ->columnSpanFull(),
                                    TextInput::make('og_title')
                                        ->label('OpenGraph (Social) Title')
                                        ->default(null),
                                    Textarea::make('og_description')
                                        ->label('OpenGraph (Social) Description')
                                        ->default(null)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),

                            Tab::make('Theme Colors')
                                ->schema([
                                    ColorPicker::make('primary_color')
                                        ->required()
                                        ->default('#3b82f6'),
                                    ColorPicker::make('secondary_color')
                                        ->required()
                                        ->default('#8b5a2b'),
                                ])
                                ->columns(2),

                            Tab::make('Social Media')
                                ->schema([
                                    TextInput::make('facebook_url')->url()->default(null),
                                    TextInput::make('instagram_url')->url()->default(null),
                                    TextInput::make('twitter_url')->url()->default(null),
                                    TextInput::make('github_url')->url()->default(null),
                                    TextInput::make('tiktok_url')->url()->default(null),
                                    TextInput::make('discord_url')->url()->default(null),
                                    TextInput::make('whatsapp_number')->default(null),
                                ])
                                ->columns(2),

                            Tab::make('Announcement Bar')
                                ->schema([
                                    Toggle::make('show_announcement')
                                        ->label('Tampilkan Announcement Bar')
                                        ->default(true),
                                    ColorPicker::make('announcement_bg_color')
                                        ->label('Warna Background')
                                        ->required()
                                        ->default('#1e3a8a'),
                                    ColorPicker::make('announcement_text_color')
                                        ->label('Warna Teks')
                                        ->required()
                                        ->default('#ffffff'),
                                    RichEditor::make('announcement_text')
                                        ->label('Teks Pengumuman')
                                        ->placeholder('Tulis teks pengumuman di sini...')
                                        ->columnSpanFull(),
                                ])
                                ->columns(3),
                        ]),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->record($this->getRecord())
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $record = $this->getRecord();

        if (! $record) {
            $record = new AppSetting;
        }

        $record->fill($data);
        $record->save();

        if ($record->wasRecentlyCreated) {
            $this->form->record($record)->saveRelationships();
        }

        Notification::make()
            ->success()
            ->title('Settings saved successfully.')
            ->send();
    }

    public function getRecord(): ?AppSetting
    {
        return AppSetting::first();
    }
}
