<?php
namespace App\Http\Controllers;
use App\Data\DemoData;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DemoController extends Controller
{
    public function index(Request $request): View
    {
        $role = $request->segment(1);
        $modules = $role === 'admin'
            ? ['doctors', 'patients', 'institutions', 'medicines', 'appointments', 'reports']
            : ['patients', 'appointments', 'medicines', 'treatments', 'settings'];
        $module = $request->segment(2);
        abort_if($module && ! in_array($module, $modules, true), 404);
        // IDs may be browser-created demo records; the client resolves them locally.
        abort_if(count($request->segments()) > 4, 404);
        abort_if($request->segment(4) && $request->segment(4) !== 'edit', 404);
        return view('demo', ['seed' => DemoData::all(), 'role' => $role]);
    }
}
