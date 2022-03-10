<?php

namespace App\Services;

use App\Models\Setting;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;

class SettingService
{
    public static function uploadLogoOrIcon($request, $key)
    {
        if ($request->hasFile($key)) {
            $setting = Setting::where('name', $key)->first();
            if (File::exists('images/' . $setting->value)) {
                File::delete('images/' . $setting->value);
            }
            $image = $request->file($key);
            $imageName = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            if ($key == "site_favicon") {
                $height = 33;
                $width = 33;
            } else {
                $height = 50;
                $width = 100;
            }
            Image::make($image)->resize($width, $height)->save('images/' . $imageName, 50);
            $setting->value = $imageName;
            $setting->save();
        }
    }

    public static function setEnv($request)
    {


        updateEnv(['MAIL_MAILER' => $request->mail_mailer]);
        updateEnv(['MAIL_HOST' => $request->mail_host]);
        updateEnv(['MAIL_PORT' => $request->mail_port]);
        updateEnv(['MAIL_USERNAME' => $request->mail_username]);
        updateEnv(['MAIL_PASSWORD' => $request->mail_password]);
        updateEnv(['MAIL_ENCRYPTION' => $request->mail_encryption]);
        updateEnv(['MAIL_FROM_ADDRESS' => $request->mail_from_address]);
        updateEnv(['MAIL_FROM_NAME' => $request->mail_from_name]);

        updateEnv(['FACEBOOK_CLIENT_ID' => $request->facebook_client_id]);
        updateEnv(['FACEBOOK_CLIENT_SECRET' => $request->facebook_client_secret]);
        updateEnv(['GOOGLE_CLIENT_ID' => $request->google_client_id]);
        updateEnv(['GOOGLE_CLIENT_SECRET' => $request->google_client_secret]);
        updateEnv(['APP_NAME' => '"'.$request->site_title.'"' ]);
    }
}
