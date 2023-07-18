<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function getDataKriteria(){
        $dataKriteria = Criteria::all();

        return view('data-kriteria', [
            'dataKriteria' => $dataKriteria
        ]);
    }

    public function tambahKriteria(Request $req){
        $validatedData = $req->validate([
            'nama' => 'required|string'
        ]);

        Criteria::create($validatedData);

        return redirect()->back();
    }

    public function perbaruiKriteria(Request $req, $id){
        $kriteria = Criteria::findOrFail($id);

        $validatedData = $req->validate([
            'nama' => 'required|string'
        ]);

        $kriteria->update($validatedData);

        return redirect()->back();
    }

    public function hapusKriteria($id){
        $kriteria = Criteria::findOrFail($id);

        $kriteria->delete();

        return redirect()->back();
    }
}
