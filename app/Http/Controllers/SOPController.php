<?php

namespace App\Http\Controllers;

use App\Models\SOP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SOPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.sop.index');
    }

    public function getData()
    {
        $sop = SOP::all();

        return DataTables::of($sop)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.sop.create');
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

            $file_name = "sop-" . $data['name'] . "." . $extension;

            $data['file'] = $images->storeAs('file', $file_name, 'public');
        }

        SOP::create($data);

        notify()->success('Succesfully Create SOP');

        return redirect()->route('index-sop');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = SOP::findOrFail($id);

        return view('pages.admin.sop.edit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $sop = SOP::findOrFail($id);

        if ($request->hasFile('file')) {

            if ($sop->file) {
                Storage::disk('public')->delete($sop->file);
            }

            $images = $request->file('file');

            $extension = $images->getClientOriginalExtension();

            $file_name = "sop-" . $data['name'] . "." . $extension;

            $data['file'] = $images->storeAs('file', $file_name, 'public');
        } else {
            unset($data['file']);
        }

        $sop->update($data);
        notify()->success('Succesfully Update SOP');

        return redirect()->route('index-sop');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sop = SOP::findOrFail($id);

        if ($sop->file) {
            Storage::disk('public')->delete($sop->file);
        }

        $sop->delete();
        notify()->success('Succesfully Delete SOP');

        return redirect()->route('index-sop');
    }

    public function deleteSelected(Request $request)
    {
        $selectedIdsString = $request->input('selectedIds')[0]; 
        $selectedIdsArray = explode(',', $selectedIdsString);

        if (!empty($selectedIdsArray)) {
            SOP::whereIn('id', $selectedIdsArray)->delete();

            notify()->success('Succesfully Delete SOP');
            return redirect()->back();
        }

        return notify()->success('Please Select SOP');
    }
}
