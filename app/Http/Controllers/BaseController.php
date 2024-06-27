<?php

namespace App\Http\Controllers;

use App\Models\IK;
use App\Models\Materials;
use App\Models\SOP;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BaseController extends Controller
{
    public function index()
    {
        $material = Materials::all();

        return view('pages.home', [
            'material' => $material
        ]);
    }

    public function materials(Request $request)
    {
        $filter = Materials::with('images')->where('materials_type_id', 1)->get();
        $fastMoving = Materials::with('images')->where('materials_type_id', 2)->get();
        $slowMoving = Materials::with('images')->where('materials_type_id', 3)->get();
        $critical = Materials::with('images')->where('materials_type_id', 4)->get();

        $keyword = $request->input('keyword');
        $materials = Materials::with('images')->where('name', 'like', '%' . $keyword . '%')->get();

        if ($request->ajax()) {
            return view('materials.search-results', compact('materials'))->render();
        }

        if ($keyword) {
            return view('pages.materials-search', compact('materials'));
        } else {
            return view('pages.materials', [
                'filter' => $filter,
                'fastMoving' => $fastMoving,
                'slowMoving' => $slowMoving,
                'critical' => $critical,
            ]);
        }
    }

    public function materialsDetail($slug)
    {
        $data = Materials::with('images')->where('slug', $slug)->firstOrFail();
        // dd($data);

        $firstImage = $data->images->first();

        $otherImage = $data->images->slice(1);

        $similarData = Materials::with('images')
            ->where('materials_type_id', $data->materials_type_id)
            ->where('slug', '!=', $data->slug)
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('pages.material-detail', compact('data', 'firstImage', 'otherImage', 'similarData'));
    }

    public function sop()
    {
        return view('pages.sop');
    }

    public function instruksiKerja(Request $request) {
        $data = IK::all();

        $keyword = $request->input('keyword');
        $ik = IK::where('name', 'like', '%' . $keyword . '%')->get();

        if ($keyword === null) {
            return view('pages.instruksi-kerja', compact('data'));
        }

        if ($keyword) {
            return view('pages.instruksi-kerja-search', compact('ik'));
        } else {
            return view('pages.instruksi-kerja', compact('data'));
        }
    }

    public function about()
    {
        return view('pages.about');
    }

    public function getDataLimit(){
        $limit = Materials::orderBy('updated_at', 'desc')->whereColumn('new_stock', '<=', 'limit_stock')->get();

        return DataTables::of($limit)->make(true);
    }
}
