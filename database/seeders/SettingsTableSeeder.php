<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Settings;

class SettingsTableSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key'   => 'app_name',
                'value' => 'Admin Dashboard',
                'type'  => 'text',
            ],
            [
                'key'   => 'app_logo',
                'value' => null, // default kosong
                'type'  => 'image',
            ],
            [
                'key'   => 'email',
                'value' => 'admin@example.com',
                'type'  => 'text',
            ],
            [
                'key'   => 'phone',
                'value' => '08123456789',
                'type'  => 'text',
            ],
            [
                'key'   => 'maintenance_mode',
                'value' => '0',
                'type'  => 'boolean',
            ],
        ];

        foreach ($settings as $setting) {
            Settings::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
