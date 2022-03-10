<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // General Settings
        Setting::updateOrCreate(['name' => 'site_title', 'value' => 'Site Name']);
        Setting::updateOrCreate(['name' => 'site_description', 'value' => 'Demo Description']);
        Setting::updateOrCreate(['name' => 'site_logo', 'value' => '']);
        Setting::updateOrCreate(['name' => 'site_favicon', 'value' => '']);

        // Socialite Settings
        // Setting::updateOrCreate(['name' => 'facebook_client_id', 'value' => null]);
        // Setting::updateOrCreate(['name' => 'facebook_client_secret', 'value' => null]);
        // Setting::updateOrCreate(['name' => 'google_client_id', 'value' => null]);
        // Setting::updateOrCreate(['name' => 'google_client_secret', 'value' => null]);

        // Mail Settings
        // Setting::updateOrCreate(['name' => 'mail_mailer', 'value' => 'mail']);
        // Setting::updateOrCreate(['name' => 'mail_host', 'value' => 'mail.domain.com']);
        // Setting::updateOrCreate(['name' => 'mail_port', 'value' => '26']);
        // Setting::updateOrCreate(['name' => 'mail_username', 'value' => 'email@domain.com']);
        // Setting::updateOrCreate(['name' => 'mail_password', 'value' => '']);
        // Setting::updateOrCreate(['name' => 'mail_encryption', 'value' => 'TLS']);
        // Setting::updateOrCreate(['name' => 'mail_from_address', 'value' => 'email@domain.com']);
        // Setting::updateOrCreate(['name' => 'mail_from_name', 'value' => 'Site name']);

        // Setting::updateOrCreate(['name' => 'mail_mailer', 'value' => 'smtp']);
        // Setting::updateOrCreate(['name' => 'mail_host', 'value' => 'smtp.mailtrap.io']);
        // Setting::updateOrCreate(['name' => 'mail_port', 'value' => '2525']);
        // Setting::updateOrCreate(['name' => 'mail_username', 'value' => '1a50725b1cc506']);
        // Setting::updateOrCreate(['name' => 'mail_password', 'value' => '552562c123ab41']);
        // Setting::updateOrCreate(['name' => 'mail_encryption', 'value' => 'TLS']);
        // Setting::updateOrCreate(['name' => 'mail_from_address', 'value' => '']);
        // Setting::updateOrCreate(['name' => 'mail_from_name', 'value' => '']);
        // Setting::updateOrCreate(['name' => 'mail_mailer', 'value' => 'smtp']);

        Setting::updateOrCreate(['name' => 'mail_host', 'value' => '']);
        Setting::updateOrCreate(['name' => 'mail_port', 'value' => '']);
        Setting::updateOrCreate(['name' => 'mail_username', 'value' => '']);
        Setting::updateOrCreate(['name' => 'mail_password', 'value' => '']);
        Setting::updateOrCreate(['name' => 'mail_encryption', 'value' => 'TLS']);
        Setting::updateOrCreate(['name' => 'mail_from_address', 'value' => '']);
        Setting::updateOrCreate(['name' => 'mail_from_name', 'value' => '']);
    }
}
