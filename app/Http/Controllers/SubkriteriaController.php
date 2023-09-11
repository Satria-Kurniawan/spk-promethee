<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    public function getDataSubkriteria()
    {
        $dataSubkriteria = Subkriteria::all();
        $dataKriteria = Criteria::all();

        return view('data-subkriteria', [
            'dataSubkriteria' => $dataSubkriteria,
            'dataKriteria' => $dataKriteria
        ]);
    }

    public function tambahSubkriteria(Request $req)
    {
        $validatedData = $req->validate([
            'nama' => 'required|string',
            'bobot' => 'required|integer',
            'id_kriteria' => 'required'
        ]);

        Subkriteria::create($validatedData);

        notify()->success('Berhasil menambahkan data subkriteria ⚡️');
        return redirect()->route('data-subkriteria');
    }

    public function perbaruiSubkriteria(Request $req, $id)
    {
        $subkriteria = Subkriteria::findOrFail($id);

        $validatedData = $req->validate([
            'nama' => 'required|string',
            'bobot' => 'required|integer',
            'id_kriteria' => 'required'
        ]);

        $subkriteria->update($validatedData);

        notify()->success('Berhasil memperbarui data subkriteria ⚡️');
        return redirect()->back();
    }

    public function hapusSubkriteria($id)
    {
        $subkriteria = Subkriteria::findOrFail($id);

        $subkriteria->delete();

        notify()->success('Berhasil menghapus data subkriteria ⚡️');
        return redirect()->back();
    }
}
