<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MultipurposeController extends Controller
{
    public function maintenanceMode()
    {
        $this->authorize('maintenance-mode');
        return view('admin.others.maintenance');
    }

    public function maintenanceModeUpdate(Request $request)
    {
        $this->authorize('maintenance-mode');
        if ($request->has('status')) {
           Artisan::call('down');
           updateEnv(['MAINTENANCE_MODE' => 'true']);
        } else {
            Artisan::call('up');
            updateEnv(['MAINTENANCE_MODE' => 'false']);
        }
        notify()->success("Successful.", "Success");
        return back();
    }
}
