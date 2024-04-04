<?php

namespace App\Http\Controllers;

use App\Models\IK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class IKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.ik.index');
    }

    public function getData()
    {
        $ik = IK::all();

        return DataTables::of($ik)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.ik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'file' => 'required|mimes:pdf',
        ]);

        if ($request->hasFile('file')) {
            $images = $request->file('file');

            $extension = $images->getClientOriginalExtension();

            $file_name = "ik-" . $data['name'] . "." . $extension;

            $data['file'] = $images->storeAs('ik', $file_name, 'public');
        }

        IK::create($data);

        notify()->success('Succesfully Create Instruksi Kerja');

        return redirect()->route('index-ik');
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
        $data = IK::findOrFail($id);

        return view('pages.admin.ik.edit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $ik = IK::findOrFail($id);

        if ($request->hasFile('file')) {

            if ($ik->file) {
                Storage::disk('public')->delete($ik->file);
            }

            $images = $request->file('file');

            $extension = $images->getClientOriginalExtension();

            $file_name = "ik-" . $data['name'] . "." . $extension;

            $data['file'] = $images->storeAs('ik', $file_name, 'public');
        } else {
            unset($data['file']);
        }

        $ik->update($data);

        notify()->success('Succesfully Update Instruksi Kerja');

        return redirect()->route('index-ik');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ik = IK::findOrFail($id);

        if ($ik->file) {
            Storage::disk('public')->delete($ik->file);
        }

        $ik->delete();

        notify()->success('Succesfully Delete Instruksi Kerja');

        return redirect()->route('index-ik');
    }
}
