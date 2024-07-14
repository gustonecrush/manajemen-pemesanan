<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|string|max:255|unique:barangs',
            'nama_barang' => 'required|string|max:255',
            'harga_jual' => 'required|integer',
            'stok_barang' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $barang = new Barang();
            $barang->kode_barang = $request->kode_barang;
            $barang->nama_barang = $request->nama_barang;
            $barang->harga_jual = $request->harga_jual;
            $barang->stok_barang = $request->stok_barang;
            $barang->save();

            toast('Barang has been added successfully.', 'success');
            return redirect()->route('admin.barangPage');
        } catch (\Exception $e) {
            toast('Failed to add Barang: ' . $e->getMessage(), 'error');
            return redirect()->back()->withInput();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|string|max:255,',
            'nama_barang' => 'required|string|max:255',
            'harga_jual' => 'required|integer',
            'stok_barang' => 'required|integer',

        ]);

        if ($validator->fails()) {
            toast('Failed to add barang.', 'error');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $barang = Barang::where('id', '=', $request->id)->first();
            $barang->update([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'harga_jual' => $request->harga_jual,
                'stok_barang' => $request->stok_barang,
            ]);

            toast('Barang has been updated successfully.', 'success');
            return redirect()->route('admin.barangPage');
        } catch (\Exception $e) {
            toast('Failed to update Barang: ' . $e->getMessage(), 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $barang = Barang::findOrFail($request->id);
        $barang->delete();

        toast('Barang has been deleted successfully.', 'success');
        return redirect()->route('admin.barangPage');
    }
}
