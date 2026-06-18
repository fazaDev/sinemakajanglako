<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProfileInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Komunitas')
                            ->weight('bold')
                            ->size('lg'),
                        TextEntry::make('description')
                            ->label('Sejarah / Tentang')
                            ->markdown()
                            ->columnSpanFull(),
                        TextEntry::make('vision')
                            ->label('Visi')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('mission')
                            ->label('Misi')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),

                Grid::make(2)
                    ->schema([
                        Section::make('Kontak')
                            ->schema([
                                TextEntry::make('address')->label('Alamat')->icon('heroicon-o-map-pin'),
                                TextEntry::make('email')->label('Email')->icon('heroicon-o-envelope'),
                                TextEntry::make('phone')->label('Telepon')->icon('heroicon-o-phone'),
                            ]),

                        Section::make('Media Sosial')
                            ->schema([
                                TextEntry::make('facebook')->label('Facebook')->url(fn ($state) => $state)->openUrlInNewTab(),
                                TextEntry::make('instagram')->label('Instagram')->url(fn ($state) => $state)->openUrlInNewTab(),
                                TextEntry::make('youtube')->label('YouTube')->url(fn ($state) => $state)->openUrlInNewTab(),
                                TextEntry::make('twitter')->label('Twitter/X')->url(fn ($state) => $state)->openUrlInNewTab(),
                                TextEntry::make('tiktok')->label('TikTok')->url(fn ($state) => $state)->openUrlInNewTab(),
                            ]),
                    ]),

                Section::make('Logo')
                    ->collapsible()
                    ->schema([
                        ImageEntry::make('logo')
                            ->label('')
                            ->disk('public'),
                    ]),
            ]);
    }
}
