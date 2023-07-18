<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Athlete;
use App\Models\Criteria;
use App\Models\Subkriteria;

class AthleteController extends Controller
{
    public function tambahAtlet(Request $req){
        $data = $req->all();

        unset($data['_token']);
        unset($data['nama']);

        $data = array_map('floatval', $data);

        $validatedData = $req->validate([
            'nama' => 'required',
        ]);

        Athlete::create([
            'nama' => $validatedData['nama'],
            'data' => $data
        ]);

        return redirect()->route('data-atlet');
    }

    public function getDataAtlet(){
        $dataAtlet = Athlete::all();
        $dataKriteria = Criteria::all();
        $dataSubkriteria = Subkriteria::all();

        return view('data-atlet', [
            'dataAtlet' => $dataAtlet,
            'dataKriteria' => $dataKriteria,
            'dataSubkriteria' => $dataSubkriteria
        ]);
    }

    public function perbaruiAtlet(Request $req, $id){
        $validatedData = $req->validate([
            'nama' => 'required',
            "umur" => 'required',
            'otot_kaki' => 'required',
            'otot_lengan' => 'required',
            'teknik' => 'required',
            'prestasi' => 'required'
        ]);

        $atlet = Athlete::findOrFail($id);
        $atlet->update($validatedData);

        return redirect()->route('data-atlet');
    }

    public function hapusAtlet($id){
        $atlet = Athlete::findOrFail($id);
        $atlet->delete();

        return redirect()->route('data-atlet');
    }
}
