<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function getDataKriteria()
    {
        $dataKriteria = Criteria::all();

        return view('data-kriteria', [
            'dataKriteria' => $dataKriteria
        ]);
    }

    public function tambahKriteria(Request $req)
    {
        $validatedData = $req->validate([
            'nama' => 'required|string'
        ]);

        Criteria::create($validatedData);

        notify()->success('Berhasil menambahkan data kriteria ⚡️');
        return redirect()->back();
    }

    public function perbaruiKriteria(Request $req, $id)
    {
        $kriteria = Criteria::findOrFail($id);

        $validatedData = $req->validate([
            'nama' => 'required|string'
        ]);

        $kriteria->update($validatedData);

        notify()->success('Berhasil memperbarui data kriteria ⚡️');
        return redirect()->back();
    }

    public function hapusKriteria($id)
    {
        $kriteria = Criteria::findOrFail($id);

        $kriteria->delete();

        notify()->success('Berhasil menghapus data kriteria ⚡️');
        return redirect()->back();
    }
}
