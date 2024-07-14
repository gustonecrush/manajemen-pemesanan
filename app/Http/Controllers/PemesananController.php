<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
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
            'no_po' => 'nullable|string',
            'no_do' => 'required|string',
            'date_order' => 'nullable|date',
            'mitra_id' => 'required',
            'unit' => 'required|string',
            'prepared_by' => 'nullable|string',
            'received_by' => 'nullable|string',
        ]);


        if ($validator->fails()) {
            toast('Failed to add pemesanan.', 'error');

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $pemesanan = new Pemesanan();

            $pemesanan->mitra_id = $request['mitra_id'];
            $pemesanan->no_po = $request['no_po'];
            $pemesanan->no_do = $request['no_do'];
            $pemesanan->date_order = $request['date_order'];
            $pemesanan->unit = $request['unit'];
            $pemesanan->prepared_by = $request['prepared_by'];
            $pemesanan->received_by = $request['received_by'];
            $pemesanan->save();

            toast('Pemesanan has been added successfully.', 'success');

            if (Auth::guard('mitra')->check()) {
                return redirect()->route('mitra.pemesananPage');
            } else {
                return redirect()->route('admin.pemesananPage');
            }
        } catch (\Exception $e) {
            toast('Failed to added pemesanan: ' . $e->getMessage(), 'error');
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
        $validatedData = $request->validate([
            'no_po' => 'nullable|string',
            'no_do' => 'required|string',
            'date_order' => 'nullable|date',
            'unit' => 'required|string',
            'prepared_by' => 'nullable|string',
            'received_by' => 'nullable|string',
            'mitra_id' => 'required'
        ]);

        try {
            $pemesanan = Pemesanan::where('id', '=', $request->id)->first();
            $pemesanan->update([
                'no_po' => $request->no_po,
                'mitra_id' => $request->mitra_id,
                'no_do' => $request->no_do,
                'date_order' => $request->date_order,
                'unit' => $request->unit,
                'prepared_by' => $request->prepared_by,
                'received_by' => $request->received_by,
            ]);

            toast('Pemesanan has been updated successfully.', 'success');
            if (Auth::guard('mitra')->check()) {
                return redirect()->route('mitra.pemesananPage');
            } else {
                return redirect()->route('admin.pemesananPage');
            }
        } catch (\Exception $e) {
            toast('Failed to update Pemesanan: ' . $e->getMessage(), 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $pemesanan = Pemesanan::where('id', '=', $request->id);
        $pemesanan->delete();

        toast('Pemesanan has been deleted successfully.', 'success');
        if (Auth::guard('mitra')->check()) {
            return redirect()->route('mitra.pemesananPage');
        } else {
            return redirect()->route('admin.pemesananPage');
        }
    }
}
