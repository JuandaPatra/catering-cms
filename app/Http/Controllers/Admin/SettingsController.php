<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::all()->pluck('value', 'key')->toArray();

        // return $settings;
        return view('admin.settings.index', compact('settings'));
    }
    public function edit()
    {
        return view('admin.settings.edit');
    }

    public function update(Request $request)
    {

        // Validasi input sesuai kebutuhan
        $request->validate([
            'app_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'maintenance_mode' => 'required|boolean',
            'app_logo' => 'nullable|image|max:2048', // Maksimal 2MB
        ]);

        // Simpan pengaturan menggunakan model Settings
        \App\Models\Settings::set('app_name', $request->input('app_name'));
        \App\Models\Settings::set('email', $request->input('email'));
        \App\Models\Settings::set('phone', $request->input('phone'));
        \App\Models\Settings::set('maintenance_mode', $request->input('maintenance_mode'));

        // Handle upload logo jika ada
        if ($request->hasFile('app_logo')) {
            $path = $request->file('app_logo')->store('public/logos');
            \App\Models\Settings::set('app_logo', $path);
        }

         Alert::success('Success', 'Data berhasil disimpan');

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully.');
    }   


}
