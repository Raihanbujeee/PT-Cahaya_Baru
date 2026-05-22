<?php

namespace App\Filament\Resources\FooterSettings\Schemas;

// 1. Hapus use Form, ganti ke Schema
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
// 2. Import Forms untuk mengambil komponen inputnya
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;

class FooterSettingForm
{
    // 3. Ubah parameter menjadi Schema $schema
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Informasi Utama')
                ->description('Atur deskripsi perusahaan dan jam operasional')
                ->schema([
                    RichEditor::make('description')
                        ->label('Deskripsi PT')
                        ->placeholder('Contoh: Pusat perbelanjaan bahan bangunan...')
                        ->columnSpanFull()
                        ->required(),
                    
                    TextInput::make('hours')
                        ->label('Jam Operasional')
                        ->placeholder('Contoh: Senin - Sabtu: 08:00 - 17:00')
                        ->required(),
                ])->columns(1)->columnSpanFull(),

            Section::make('Kontak Kami')
                ->description('Alamat, Telepon, dan Email resmi')
                ->schema([
                    TextInput::make('address')
                        ->label('Alamat Lengkap')
                        ->required(),

                    TextInput::make('phone')
                        ->label('Nomor Telepon')
                        ->tel()
                        ->required(),

                    TextInput::make('email')
                        ->label('Email Resmi')
                        ->email()
                        ->required(),
                ])->columns(2),

            Section::make('Tautan Sosial Media')
                ->description('Masukkan link lengkap (https://...)')
                ->schema([
                    TextInput::make('social_links.facebook')
                        ->label('Facebook')
                        ->url()
                        ->placeholder('https://facebook.com/nama-page'),

                    TextInput::make('social_links.instagram')
                        ->label('Instagram')
                        ->url()
                        ->placeholder('https://instagram.com/nama-akun'),

                    TextInput::make('social_links.x')
                        ->label('X (Twitter)')
                        ->url()
                        ->placeholder('https://x.com/nama-akun'),

                    TextInput::make('social_links.youtube')
                        ->label('YouTube')
                        ->url()
                        ->placeholder('https://youtube.com/c/nama-channel'),
                ])->columns(2),
        ]);
    }
}