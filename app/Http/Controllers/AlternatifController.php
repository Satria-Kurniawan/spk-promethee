<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Criteria;
use App\Models\Subkriteria;

class AlternatifController extends Controller
{
    public function tambahAlternatif(Request $req)
    {
        $data = $req->all();

        unset($data['_token']);
        unset($data['nama']);

        // $data = array_map('floatval', $data);

        $validatedData = $req->validate([
            'nama' => 'required',
        ]);

        Alternatif::create([
            'nama' => $validatedData['nama'],
            'data' => $data
        ]);

        notify()->success('Berhasil menambahkan data kriteria ⚡️');
        return redirect()->route('data-alternatif');
    }

    public function getDataAlternatif()
    {
        $dataAlternatif = Alternatif::all();
        $dataKriteria = Criteria::all();
        $dataSubkriteria = Subkriteria::all();

        return view('data-alternatif', [
            'dataAlternatif' => $dataAlternatif,
            'dataKriteria' => $dataKriteria,
            'dataSubkriteria' => $dataSubkriteria
        ]);
    }

    public function perbaruiAlternatif(Request $req, $id)
    {
        $validatedData = $req->validate([
            'nama' => 'required',
            "umur" => 'required',
            'otot_kaki' => 'required',
            'otot_lengan' => 'required',
            'teknik' => 'required',
            'prestasi' => 'required'
        ]);

        $alternatif = Alternatif::findOrFail($id);
        $alternatif->update($validatedData);

        notify()->success('Berhasil memperbarui data alternatif ⚡️');
        return redirect()->route('data-alternatif');
    }

    public function hapusAlternatif($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->delete();

        notify()->success('Berhasil menghapus data alternatif ⚡️');
        return redirect()->route('data-alternatif');
    }
}
