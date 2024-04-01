<?php

namespace App\Http\Controllers;

use App\Imports\MaterialsImport;
use App\Models\MaterialImage;
use App\Models\MaterialImages;
use App\Models\Materials;
use App\Models\MaterialsType;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    public function filter()
    {
        return view('pages.admin.materials.filter.index');
    }

    public function getDataFilter()
    {
        $materials = Materials::where('materials_type_id', 1);

        return DataTables::of($materials)->make(true);
    }

    public function fastMoving()
    {
        return view('pages.admin.materials.fastMoving.index');
    }

    public function getDataFastMoving()
    {
        $materials = Materials::where('materials_type_id', 2);

        return DataTables::of($materials)->make(true);
    }

    public function critical()
    {
        return view('pages.admin.materials.critical.index');
    }

    public function getDataCritical()
    {
        $materials = Materials::where('materials_type_id', 4);

        return DataTables::of($materials)->make(true);
    }

    public function slowMoving()
    {
        return view('pages.admin.materials.slowMoving.index');
    }

    public function getDataSlowMoving()
    {
        $materials = Materials::where('materials_type_id', 3);

        return DataTables::of($materials)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $material_type = MaterialsType::all();

        return view('pages.admin.materials.create', [
            'type' => $material_type
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'photos.*' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $slug = \Str::slug($request->name);
        $data['slug'] = $slug;

        $material = Materials::create($data);

        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $extension = $photo->getClientOriginalExtension();
                $file_name = "material-" . $slug . "-" . uniqid() . "." . $extension;
                $path = $photo->storeAs('materials', $file_name, 'public');
                $photos[] = $path;
            }
        }

        foreach ($photos as $path) {
            MaterialImage::create([
                'file' => $path,
                'materials_id' => $material->id
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $material = Materials::findOrFail($id);
        $material_type = MaterialsType::all();
        $material_image = MaterialImage::where('materials_id', $id)->get();

        return view('pages.admin.materials.edit', [
            'materials' => $material,
            'type' => $material_type,
            'materials_image' => $material_image
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $material = Materials::findOrFail($id);

        $this->validate($request, [
            'photos.*' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $slug = \Str::slug($request->name);
        $data['slug'] = $slug;

        $material->update($data);

        if ($request->hasFile('photos')) {
            $imageMaterial = MaterialImage::where('materials_id', $material->id)->get();
            
            foreach ($imageMaterial as $image) {
                Storage::disk('public')->delete($image->file);
                $image->delete();
            }

            $photos = [];
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $file_name = "material-" . $slug . "-" . uniqid() . "." . $extension;
                    $path = $photo->storeAs('materials', $file_name, 'public');
                    $photos[] = $path;
                }
            }

            foreach ($photos as $path) {
                MaterialImage::create([
                    'file' => $path,
                    'materials_id' => $material->id
                ]);
            }
        }

        return redirect()->route('index-filter');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Materials::findOrFail($id);

        $images = MaterialImage::where('materials_id', $material->id)->get();

        foreach ($images as $image) {
            Storage::disk('public')->delete($image->file);
            $image->delete();
        }

        $material->delete();

        return redirect()->back();
    }

    public function importIndex() {
        return view('pages.admin.materials.import.index');
    }

    public function import(Request $request)
    {
        Excel::import(new MaterialsImport, $request->file('file'));

        return redirect('/admin/materials/filter')->with('success', 'All good!');
    }
}
