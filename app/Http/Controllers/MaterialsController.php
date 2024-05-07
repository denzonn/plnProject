<?php

namespace App\Http\Controllers;

use App\Exports\MaterialsExport;
use App\Imports\MaterialsImport;
use App\Models\MaterialImage;
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

        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $extension = $photo->getClientOriginalExtension();
                $file_name = "material-" . $slug . "-" . uniqid() . "." . $extension;
                $path = $photo->storeAs('materials', $file_name, 'public');
                $photos[] = $path;
            }

            foreach ($photos as $path) {
                MaterialImage::create([
                    'file' => $path,
                    'materials_id' => $material->id
                ]);
            }
        }


        notify()->success('Succesfully Create Materials');

        if ($data['new_stock'] <= $data['limit_stock']) {
            $sendEmailNotificationController = new sendEmailNotificationController();
            $sendEmailNotificationController->index();
        }

        if ($request->input('materials_type_id') == 1) {
            return redirect()->route('index-filter');
        } else if ($request->input('materials_type_id') == 2) {
            return redirect()->route('index-fast-moving');
        } else if ($request->input('materials_type_id') == 3) {
            return redirect()->route('index-slow-moving');
        } else {
            return redirect()->route('index-critical');
        }
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

        $selectedMaterials = json_decode($material->selected_materials);

        $selected = [];
        if ($selectedMaterials) {
            foreach ($selectedMaterials as $item) {
                $selectedMaterial = Materials::where('id', $item)->first();
                if ($selectedMaterial) {
                    $selected[] = $selectedMaterial;
                }
            }
        }

        return view('pages.admin.materials.edit', [
            'materials' => $material,
            'type' => $material_type,
            'materials_image' => $material_image,
            'selected' => $selected
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
        $selectedMaterials = $request->input('selectedMaterials');

        $selected = json_encode($selectedMaterials);

        if ($request->input('selectedMaterials') == null) {
            if ($material->selected_materials) {
                $removeAllSelected = json_decode($material->selected_materials);

                foreach ($removeAllSelected as $removeSelect) {
                    $dataRemove = Materials::find($removeSelect);

                    if ($dataRemove) {
                        $dataRemove->update([
                            'selected_materials' => null
                        ]);
                    }
                }
            }
        }

        $material->update([
            ...$data,
            'selected_materials' => $request->input('selectedMaterials') ? $selected : null
        ]);

        if ($selectedMaterials) {
            $alreadySelectedMaterials = json_decode($material->selected_materials);
            $newlySelectedMaterials = array_diff($alreadySelectedMaterials, $selectedMaterials);
            foreach ($selectedMaterials as $selectedMaterialId) {
                // Ambil data material yang dipilih
                $selectedMaterial = Materials::find($selectedMaterialId);

                // Salin array selectedMaterials ke dalam variabel $selects
                $selects = $selectedMaterials;

                if ($selectedMaterial->selected_materials) {
                    $dataWillNull = json_decode($selectedMaterial->selected_materials);

                    foreach ($dataWillNull as $willNull) {
                        $dataNull = Materials::find($willNull);

                        if ($material->id != $dataNull->id) {
                            if ($dataNull) {
                                $dataNull->update([
                                    'selected_materials' => null
                                ]);
                            }
                        }
                    }
                    $selectedMaterial->update([
                        'selected_materials' => null
                    ]);
                }

                // Hapus ID bahan yang sedang diedit dari array $selects
                $updatedSelectedMaterials = array_diff($selects, [$selectedMaterialId]);

                // Tambahkan ID bahan yang sedang diedit ke dalam array $updatedSelectedMaterials
                $updatedSelectedMaterials[] = strval($material->id);

                // Ubah indeks array menjadi nilai-nilai yang berurutan
                $updatedSelectedMaterials = array_values($updatedSelectedMaterials);

                // Update selected_materials dari material yang dipilih
                $selectedMaterial->update([
                    'name' => $selectedMaterial->name,
                    'slug' => $selectedMaterial->slug,
                    'spesification' => $selectedMaterial->spesification,
                    'materials_type_id' => $selectedMaterial->materials_type_id,
                    'last_placement_data' => $selectedMaterial->last_placement_data,
                    'selected_materials' => json_encode($updatedSelectedMaterials),
                    'new_stock' => $request->input('new_stock'),
                    'limit_stock' => $request->input('limit_stock'),
                    'used_stock' => $request->input('used_stock'),
                    'purchase_link' => $request->input('purchase_link')
                ]);

                if ($request->hasFile('photos')) {
                    $imageMaterial = MaterialImage::where('materials_id', $selectedMaterial->id)->get();

                    foreach ($imageMaterial as $image) {
                        Storage::disk('public')->delete($image->file);
                        $image->delete();
                    }

                    $photosSelected = [];
                    if ($request->hasFile('photos')) {
                        foreach ($request->file('photos') as $photo) {
                            $extension = $photo->getClientOriginalExtension();
                            $file_name = "material-" . $selectedMaterial->slug . "-" . uniqid() . "." . $extension;
                            $path = $photo->storeAs('materials', $file_name, 'public');
                            $photosSelected[] = $path;
                        }
                    }

                    foreach ($photosSelected as $path) {
                        MaterialImage::create([
                            'file' => $path,
                            'materials_id' => $selectedMaterial->id
                        ]);
                    }
                } else {
                    $imageMaterial = MaterialImage::where('materials_id', $selectedMaterial->id)->get();
                    if ($imageMaterial) {
                        foreach ($imageMaterial as $image) {
                            Storage::disk('public')->delete($image->file);
                            $image->delete();
                        }
                    }

                    $imageUpdate = MaterialImage::where('materials_id', $material->id)->get();

                    foreach ($imageUpdate as $newImage) {
                        // Tentukan path penyimpanan baru untuk file yang akan disalin
                        $fileParts = explode('.', $selectedMaterial->file);
                        $extension = end($fileParts);
                        $newFileName = "material-" . $selectedMaterial->slug . "-" . uniqid() . "." . $extension;
                        $destinationPath = 'materials/' . $newFileName;

                        // Salin file ke direktori penyimpanan baru
                        Storage::copy($newImage->file, $destinationPath);

                        // Simpan nama file baru ke dalam database
                        MaterialImage::create([
                            'file' => $destinationPath,
                            'materials_id' => $selectedMaterial->id
                        ]);
                    }
                }
            }
            if ($newlySelectedMaterials) {
                foreach ($newlySelectedMaterials as $item) {
                    $selectedMaterial = Materials::find($item);

                    $selectedMaterial->update([
                        'selected_materials' => null,
                    ]);
                }
            }
        }


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


        if ($data['new_stock'] <= $data['limit_stock']) {
            $sendEmailNotificationController = new sendEmailNotificationController();
            $sendEmailNotificationController->index();
        }

        if ($material->materials_type_id === '1') {
            notify()->success('Succesfully Update Materials');
            return redirect()->route('index-filter');
        } elseif ($material->materials_type_id === '2') {
            notify()->success('Succesfully Update Materials');
            return redirect()->route('index-fast-moving');
        } elseif ($material->materials_type_id === '3') {
            notify()->success('Succesfully Update Materials');
            return redirect()->route('index-slow-moving');
        } else {
            notify()->success('Succesfully Update Materials');
            return redirect()->route('index-critical');
        }
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

        if ($material->selected_materials) {
            $selectedMaterials = json_decode($material->selected_materials);

            foreach ($selectedMaterials as $item) {
                $selectedMaterial = Materials::find($item);

                $selectedMaterial->update([
                    'selected_materials' => null,
                ]);
            }
        }

        $material->delete();

        notify()->success('Succesfully Delete Materials');

        return redirect()->back();
    }

    public function importIndex()
    {
        return view('pages.admin.materials.import.index');
    }

    public function import(Request $request)
    {
        Excel::import(new MaterialsImport, $request->file('file'));

        notify()->success('Succesfully Import Materials');

        return redirect('/admin/materials/filter')->with('success', 'All good!');
    }

    public function export()
    {
        return Excel::download(new MaterialsExport, 'materials.xlsx');
    }

    public function getSimilarMaterial(Request $request)
    {
        $query = Materials::where('name', 'LIKE', '%' . $request->q . '%');

        if ($request->has('materials_type_id')) {
            $query->where('materials_type_id', $request->materials_type_id);
        }

        $data = $query->paginate(10);

        return response()->json($data);
    }
}
