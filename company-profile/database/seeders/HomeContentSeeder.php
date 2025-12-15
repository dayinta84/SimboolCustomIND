<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HomeContent;

class HomeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (HomeContent::count() === 0) {
            HomeContent::create([
                'hero_title' => 'SIMBOOL CUSTOM INDUSTRIES',
                'hero_subtitle' => 'digital printing and everything<br>Build for quality',
                'hero_background' => null,
                'services' => [
                    ['title'=>'Stiker','image'=>null,'desc'=>'Custom sticker'],
                    ['title'=>'Sablon Kaos','image'=>null,'desc'=>'Screen printing'],
                    // dst...
                ],
                'tagline' => 'Build for quality',
            ]);
        }
    }
}

//kayake gk kepake
