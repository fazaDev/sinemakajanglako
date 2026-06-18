<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | INFORMASI UTAMA
                |--------------------------------------------------------------------------
                */
                Group::make([
                    Section::make('Informasi Dasar')
                        ->description('Informasi utama mengenai profil atau identitas komunitas.')
                        ->schema([
                            TextInput::make('name')
                                ->label('Nama Komunitas')
                                ->required()
                                ->columnSpanFull(),

                            RichEditor::make('description')
                                ->label('Sejarah / Tentang Kami')
                                ->required()
                                ->columnSpanFull(),

                            RichEditor::make('vision')
                                ->label('Visi')
                                ->columnSpanFull(),

                            RichEditor::make('mission')
                                ->label('Misi')
                                ->columnSpanFull(),
                        ]),
                ])
                ->columnSpan(['lg' => 2]),

                /*
                |--------------------------------------------------------------------------
                | KONTAK & MEDIA SOSIAL
                |--------------------------------------------------------------------------
                */
                Group::make([
                    Section::make('Kontak & Identitas')
                        ->schema([
                            FileUpload::make('logo')
                                ->label('Logo Komunitas')
                                ->image()
                                ->disk('public')
                                ->directory('profiles/logos'),

                            TextInput::make('address')
                                ->label('Alamat Lengkap'),

                            TextInput::make('email')
                                ->label('Email Resmi')
                                ->email(),

                            TextInput::make('phone')
                                ->label('Nomor Telepon')
                                ->tel(),
                        ]),

                    Section::make('Media Sosial')
                        ->schema([
                            TextInput::make('facebook')->label('Facebook'),
                            TextInput::make('instagram')->label('Instagram'),
                            TextInput::make('youtube')->label('YouTube'),
                            TextInput::make('twitter')->label('Twitter/X'),
                            TextInput::make('tiktok')->label('TikTok'),
                        ]),
                ])
                ->columnSpan(['lg' => 1]),

            ])
            ->columns(3);
    }
}
