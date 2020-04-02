<?php

namespace App\Http\Controllers\Admin;

use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigurationController extends BaseController
{
    public function index()
    {
        $conf = Configuration::where('id', '>', 0)->first();
        return view('admin.configuration.index', compact('conf'));
    }

    public function store(Request $request)
    {
        $conf = Configuration::where('id', '>', 0)->first();
        if ($request->has('turn_on_baselinker')) {
            $conf->turn_on_baselinker = 1;
        } else {
            $conf->turn_on_baselinker = 0;
        }
        $conf->status_id = $request->status_id;
        $conf->baselinker_key = $request->baselinker_key;
        $conf->baselinker_deposit_id = $request->baselinker_deposit_id;
        $conf->save();

        return redirect()->route('admin.configuration.index')->with('message', 'Zaktualizowano konfiguracje');
    }
}
