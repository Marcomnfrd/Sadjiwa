<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Addfee;
// use App\Models\Lokasi;
// use App\Models\Listorder;
// use App\Models\TambahRp;
use App\Models\TambahBiaya;
use Illuminate\Http\Request;

class BiayaLainController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            "transportasi" => "required|numeric",
            "pemasangan" => "required|numeric",
            "jasa" => "required|numeric",
            "service" => "required|numeric",
            "lokasi_id" => "required",
        ]);


        $lokasi = Pesanan::findOrFail($request->lokasi_id);

        $harga = $lokasi->hasil;

        $total_biaya = $harga + $request->transportasi + $request->pemasangan + $request->jasa + $request->service;


        TambahBiaya::create([
            "biaya_transportasi" => $request->transportasi,
            "biaya_pemasangan" => $request->pemasangan,
            "biaya_jasa" => $request->jasa,
            "biaya_service" => $request->service,
            "total_biaya" => $total_biaya,
            "lokasi_id" => $request->lokasi_id,
        ]);

        return redirect()->back()
            ->with('success', 'Lokasi created successfully.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            "transportasi" => "required|numeric",
            "pemasangan" => "required|numeric",
            "jasa" => "required|numeric",
            "service" => "required|numeric",
            "lokasi_id" => "required",
        ]);

        $lokasi = Pesanan::findOrFail($request->lokasi_id);

        $harga = $lokasi->hasil;

        $total_biaya = $harga + $request->transportasi + $request->pemasangan + $request->jasa + $request->service;

        $biaya = TambahBiaya::where('lokasi_id', $id)->firstOrFail();
        
        $biaya->update([
            "biaya_transportasi" => $request->transportasi,
            "biaya_pemasangan" => $request->pemasangan,
            "biaya_jasa" => $request->jasa,
            "biaya_service" => $request->service,
            "total_biaya" => $total_biaya,
            "lokasi_id" => $request->lokasi_id,
        ]);

        return redirect()->back()
            ->with('success', 'Lokasi updated successfully.');
    }
}
