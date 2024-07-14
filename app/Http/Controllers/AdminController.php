<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangPemesanan;
use App\Models\Mitra;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginPage()
    {
        return view('admin.login');
    }

    public function dashboardPage()
    {
        $barangs = Barang::all();
        $barangCount = Barang::all()->count();
        return view('admin.pemesanan', compact('barangs', 'barangCount'));
    }

    public function barangPage()
    {
        $barangs = Barang::all();
        $totalBarang = Barang::all()->count();
        $totalStok = Barang::sum('stok_barang');
        return view('admin.barang', compact('barangs', 'totalBarang', 'totalStok'));
    }

    public function detailPemesananPage($id)
    {
        $details = BarangPemesanan::where('pemesanan_id', $id)->with(['barang', 'pemesanan'])->get();

        $pemesanans = Pemesanan::where('id', '=', $id)->with('mitra')->first();
        $subTotal = BarangPemesanan::where('pemesanan_id', '=', $id)->sum('total');
        return view('admin.detail', compact('details', 'pemesanans', 'subTotal'));
    }

    public function invoicePemesananPage($id)
    {
        $details = BarangPemesanan::where('pemesanan_id', $id)->with(['barang', 'pemesanan'])->get();

        $pemesanans = Pemesanan::where('id', '=', $id)->with('mitra')->first();
        $subTotal = BarangPemesanan::where('pemesanan_id', '=', $id)->sum('total');

        return view('admin.detail-invoice', compact('details', 'pemesanans', 'subTotal'));
    }

    public function notaJalanPage($id)
    {
        $details = BarangPemesanan::where('pemesanan_id', $id)->with(['barang', 'pemesanan'])->get();

        $pemesanans = Pemesanan::where('id', '=', $id)->with('mitra')->first();
        $subTotal = BarangPemesanan::where('pemesanan_id', '=', $id)->sum('total');

        return view('admin.detail-nota', compact('details', 'pemesanans', 'subTotal'));
    }

    public function pemesananPage()
    {
        $pemesanans = Pemesanan::all();
        $mitras = Mitra::all();
        $barangs = Barang::all();
        $totalPemesanans = Pemesanan::all()->count();
        return view('admin.pemesanan', compact('pemesanans', 'mitras', 'totalPemesanans', 'barangs'));
    }

    public function invoicePage()
    {
        $pemesanans = Pemesanan::all();
        $mitras = Mitra::all();
        $barangs = Barang::all();
        $totalPemesanans = Pemesanan::all()->count();
        return view('admin.invoice', compact('pemesanans', 'mitras', 'totalPemesanans', 'barangs'));
    }

    public function notaPage()
    {
        $pemesanans = Pemesanan::all();
        $mitras = Mitra::all();
        $barangs = Barang::all();
        $totalPemesanans = Pemesanan::all()->count();
        return view('admin.nota', compact('pemesanans', 'mitras', 'totalPemesanans', 'barangs'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            toast('Successfully logged in. Welcome to Dashboard Admin CV Fajar Teknika.', 'success',);
            return redirect()->route('admin.pemesananPage');
        }

        toast('Failed to login, cannot find your account contact your operator!', 'error',);
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toast('Successfully logged out. Thanks has used Dashboard Admin CV Fajar Teknika.', 'success',);

        return redirect()->route('admin.login');
    }
}
