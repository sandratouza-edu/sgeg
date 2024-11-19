<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Save settings the application dashboard.
     *
     */
    public function index(): View
    {
        $settings = Setting::get(['key', 'value']);
        $ordered =[];
        
        foreach ($settings as $setting) {
            $ordered[$setting->key] = $setting->value;
        }

        return view('settings', compact('settings', 'ordered'));
    }
 
    public function save(Request $request)
    {
        $data = $request->except('_token');
 
        foreach ($data as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }
        /*
        if(!empty($request->app_name)) {
            SettingsController::setNewEnv("APP_NAME", $request->app_name);
            SettingsController::setNewEnv("ITEMS_PAGE", $request->pagination);
            SettingsController::setNewEnv("MAIL_FROM_ADDRESS", $request->admin_email);
            SettingsController::setNewEnv("MAIL_FROM_NAME", $request->sender_name);
        }
        */

        return redirect()->route('settings')->with('status', 'Successfully updated the settings.');
    }

    private function setNewEnv($key, $value)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . env($key),
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }
}
