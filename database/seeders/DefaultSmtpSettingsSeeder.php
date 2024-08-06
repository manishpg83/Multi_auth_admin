<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DefaultSmtpSetting;

class DefaultSmtpSettingsSeeder extends Seeder
{
    public function run()
    {
        $defaultSettings = [
            [
                'mailer_type' => 'Gmail',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_port' => 587,
            ],
            [
                'mailer_type' => 'Brevo',
                'smtp_host' => 'smtp.brevo.com',
                'smtp_port' => 465,
            ],
            [
                'mailer_type' => 'GetResponse',
                'smtp_host' => 'smtp.getresponse.com',
                'smtp_port' => 587,
            ],
        ];

        foreach ($defaultSettings as $settings) {
            DefaultSmtpSetting::create($settings);
        }
    }
}

