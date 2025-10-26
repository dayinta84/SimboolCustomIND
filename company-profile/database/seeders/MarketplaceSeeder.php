<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marketplace;

class MarketplaceSeeder extends Seeder
{
    public function run()
    {
        Marketplace::create([
            'platform' => 'Tiktok',
            'username' => 'Kel4',
            'followers' => '1000k',
            'description' => 'Ini akun saya',
            'link' => 'https://kompas.com',
            'icon' => 'icons/eqA00z6ZnsMIrpfImLpreUfm8LMEGncnYqJgSCq4.jpg',
        ]);
    }
}