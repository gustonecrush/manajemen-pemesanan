<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangPemesanan;
use Illuminate\Http\Request;
use App\Models\Mitra;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\Facades\Toast;

class MitraController extends Controller
{
    public function dashboardPage()
    {
        $barangs = Barang::all();
        $barangCount = Barang::all()->count();
        return view('mitra.dashboard', compact('barangs', 'barangCount'));
    }

    public function invoicePemesananPage($id)
    {
        $details = BarangPemesanan::where('pemesanan_id', $id)->with(['barang', 'pemesanan'])->get();

        $pemesanans = Pemesanan::where('id', '=', $id)->with('mitra')->first();
        $subTotal = BarangPemesanan::where('pemesanan_id', '=', $id)->sum('total');

        return view('mitra.detail-invoice', compact('details', 'pemesanans', 'subTotal'));
    }

    public function notaPage()
    {
        $pemesanans = Pemesanan::all();
        $mitras = Mitra::all();
        $barangs = Barang::all();
        $totalPemesanans = Pemesanan::all()->count();
        return view('mitra.nota', compact('pemesanans', 'mitras', 'totalPemesanans', 'barangs'));
    }

    public function notaJalanPage($id)
    {
        $details = BarangPemesanan::where('pemesanan_id', $id)->with(['barang', 'pemesanan'])->get();

        $pemesanans = Pemesanan::where('id', '=', $id)->with('mitra')->first();
        $subTotal = BarangPemesanan::where('pemesanan_id', '=', $id)->sum('total');

        return view('mitra.detail-nota', compact('details', 'pemesanans', 'subTotal'));
    }

    public function pemesananPage()
    {
        $pemesanans = Pemesanan::where('mitra_id', '=', Auth::guard('mitra')->user()->id)->get();
        $mitras = Mitra::all();
        $barangs = Barang::all();
        $totalPemesanans = Pemesanan::where('mitra_id', '=', Auth::guard('mitra')->user()->id)->count();
        return view('mitra.pemesanan', compact('pemesanans', 'mitras', 'totalPemesanans', 'barangs'));
    }

    public function invoicePage()
    {
        $pemesanans = Pemesanan::where('mitra_id', '=', Auth::guard('mitra')->user()->id)->get();
        $mitras = Mitra::all();
        $barangs = Barang::all();
        $totalPemesanans = Pemesanan::where('mitra_id', '=', Auth::guard('mitra')->user()->id)->count();
        return view('mitra.invoice', compact('pemesanans', 'mitras', 'totalPemesanans', 'barangs'));
    }

    public function detailPemesananPage($id)
    {
        $details = BarangPemesanan::where('pemesanan_id', $id)->with(['barang', 'pemesanan'])->get();

        $pemesanans = Pemesanan::where('id', '=', $id)->first();
        $subTotal = BarangPemesanan::where('pemesanan_id', '=', $id)->sum('total');
        return view('mitra.detail', compact('details', 'pemesanans', 'subTotal'));
    }

    public function registerPage()
    {
        return view('mitra.register');
    }

    public function loginPage()
    {
        return view('mitra.login');
    }

    // Register a new mitra
    public function register(Request $request)
    {

        if ($request->isMethod('post') && $request->all() == []) {
            toast('Failed to register mitra, please complete the form', 'error',);
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'site' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:mitras',
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:8',
        ]);

        try {

            $mitra = new Mitra();
            $mitra->name = $validatedData['name'];
            $mitra->site = $validatedData['site'];
            $mitra->email = $validatedData['email'];
            $mitra->phone_number = $validatedData['phone_number'];
            $mitra->password = Hash::make($validatedData['password']);
            $mitra->save();

            // Set success message and redirect to the login page
            toast('Your account has been created successfully. Please log in.', 'success',);
            return redirect()->route('mitra.loginPage');
        } catch (\Exception $e) {
            // Set error message and return back to the same page
            toast('Failed to register mitra: ' . $e->getMessage(), 'error',);
            return redirect()->back();
        }
    }



    // Login mitra
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('mitra')->attempt($credentials)) {
            $request->session()->regenerate();
            toast('Successfully logged in. Welcome to Dashboard Mitra CV Fajar Teknika.', 'success',);
            return redirect()->route('mitra.pemesananPage');
        }

        toast('Failed to login, cannot find your account!', 'error',);
        return redirect()->back();
    }

    // Logout mitra
    public function logout(Request $request)
    {
        Auth::guard('mitra')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toast('Successfully logged out. Thanks has used Dashboard Mitra CV Fajar Teknika.', 'success',);

        return redirect()->route('mitra.loginPage');
    }
}
