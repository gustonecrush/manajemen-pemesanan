<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangPemesanan;
use App\Models\InvoicePemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BarangPemesananController extends Controller
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
            'barang_id' => 'required',
            'pemesanan_id' => 'required',
            'quantity' => 'required',
            'satuan' => 'required|string',
        ]);


        if ($validator->fails()) {
            toast('Failed to add barang pemesanan.', 'error');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $pemesanan = new BarangPemesanan();

            $pemesanan->barang_id = $request['barang_id'];
            $pemesanan->pemesanan_id = $request['pemesanan_id'];
            $pemesanan->quantity = $request['quantity'];
            $pemesanan->satuan = $request['satuan'];
            $pemesanan->unit_price = Barang::where('id', '=', $request->barang_id)->first()->harga_jual;
            $pemesanan->total = Barang::where('id', '=', $request->barang_id)->first()->harga_jual * $request->quantity;
            $pemesanan->save();

            toast('Barang Pemesanan has been added successfully.', 'success');

            if (Auth::guard('mitra')->check()) {
                return redirect()->route('mitra.pemesananPage');
            } else {
                return redirect()->route('admin.pemesananPage');
            }
        } catch (\Exception $e) {
            toast('Failed to added barang pemesanan: ' . $e->getMessage(), 'error');
            return redirect()->back()->withInput();
        }
    }

    public function getPemesananDetail($id)
    {
        $details = BarangPemesanan::where('pemesanan_id', '=', $id)->with('barang')->get();

        return response()->json($details);
    }

    public function savePurchaseOrder(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/purchase_orders');
            return response()->json(['path' => Storage::url($path)]);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }

    public function storePurchaseOrder(Request $request)
    {
        // Validate request
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);

                // Save data to the database
                $invoicePemesanan = new InvoicePemesanan();
                $invoicePemesanan->pemesanan_id = $request->pemesanan_id;
                $invoicePemesanan->invoice = $imageName;
                $invoicePemesanan->save();

                return response()->json(['success' => true]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => false, 'error' => 'File not uploaded'], 400);
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
            'barang_id' => 'required',
            'pemesanan_id' => 'required',
            'quantity' => 'required',
            'satuan' => 'required|string',
            'unit_price' => 'required',
            'total' => 'required|string',
        ]);

        try {
            $pemesanan = BarangPemesanan::where('id', '=', $request->id)->first();
            $pemesanan->update([
                'barang_id' => $request->barang_id,
                'pemesanan_id' => $request->pemesanan_id,
                'quantity' => $request->quantity,
                'satuan' => $request->satuan,
                'unit_price' => $request->unit_price,
                'total' => $request->total,
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
        $barangPemesanan = BarangPemesanan::findOrFail($request->id);
        $barangPemesanan->delete();

        toast('Barang Pemesanan has been deleted successfully.', 'success');
        if (Auth::guard('mitra')) {
            return redirect()->route('mitra.pemesananPage');
        } else {
            return redirect()->route('admin.pemesananPage');
        }
    }
}
