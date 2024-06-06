<?php

namespace Database\Seeders;

use App\Models\Lang;
use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seo = Seo::create([
            'keywords' => 'keywords, for, seo'
        ]);

        // Ru translations for Seo
        $seo->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'SEO title for ru',
            'column_name' => 'title',
        ]);
        // En translations for Seo
        $seo->translations()->create([
            'lang_id' => Lang::where('code', 'en')->first()->id,
            'content' => 'SEO title for en',
            'column_name' => 'title',
        ]);
        // Uz translations for Seo
        $seo->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'SEO title for uz',
            'column_name' => 'title',
        ]);

        // Ru translations for Seo
        $seo->translations()->create([
            'lang_id' => Lang::where('code', 'ru')->first()->id,
            'content' => 'SEO description for ru',
            'column_name' => 'description',
        ]);
        // En translations for Seo
        $seo->translations()->create([
            'lang_id' => Lang::where('code', 'en')->first()->id,
            'content' => 'SEO description for en',
            'column_name' => 'description',
        ]);
        // Uz translations for Seo
        $seo->translations()->create([
            'lang_id' => Lang::where('code', 'uz')->first()->id,
            'content' => 'SEO description for uz',
            'column_name' => 'description',
        ]);
    }
}
