<?php

namespace App\Http\Controllers;

use App\Models\IK;
use App\Models\Materials;
use App\Models\SOP;

class DashboardController extends Controller
{
    public function index(){
        $filter = Materials::where('materials_type_id', 1)->count();
        $fastMoving = Materials::where('materials_type_id', 2)->count();
        $slowMoving = Materials::where('materials_type_id', 3)->count();
        $critical = Materials::where('materials_type_id', 4)->count();

        $sop = SOP::count();
        $ik = IK::count();

        return view('pages.admin.dashboard.index', [
            'filter' => $filter,
            'critical' => $critical,
            'slowMoving' => $slowMoving,
            'fastMoving' => $fastMoving,
            'sop' => $sop,
            'ik' => $ik,
        ]);
    }
}
