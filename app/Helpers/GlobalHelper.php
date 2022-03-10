<?php

use App\Models\Setting;

if (!function_exists('setting')) {

    /**
     * get the setting from database
     *
     * @param  string $name
     * @return string
     */
    function setting($name)
    {
        $setting = Setting::where('name', $name)->first();
        return $setting->value ?? NULL;
    }
}
if (!function_exists('updateEnv')) {
    function updateEnv( $data = [] ) : void
    {

        $path = base_path('.env');

        if (file_exists($path)) {
            foreach ($data as $key => $value) {
                file_put_contents($path, str_replace(
                    $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
                ));
            }
        }

    }
}
