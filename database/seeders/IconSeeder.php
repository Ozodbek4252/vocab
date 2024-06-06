<?php

namespace Database\Seeders;

use App\Models\Icon;
use Illuminate\Database\Seeder;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Icon::create([
            'name' => 'instagram',
            'icon' => 'icons/instagram.svg',
        ]);

        Icon::create([
            'name' => 'facebook',
            'icon' => 'icons/facebook.svg',
        ]);

        Icon::create([
            'name' => 'telegram',
            'icon' => 'icons/telegram.svg',
        ]);

        Icon::create([
            'name' => 'telegram_blue',
            'icon' => 'icons/telegram-blue.svg',
        ]);

        Icon::create([
            'name' => 'downloader',
            'icon' => 'icons/downloader.svg',
        ]);

        Icon::create([
            'name' => 'anchor-link',
            'icon' => 'icons/anchor-link.svg',
        ]);
    }
}
