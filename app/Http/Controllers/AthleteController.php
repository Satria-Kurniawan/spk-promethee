<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Athlete;

class AthleteController extends Controller
{
    public function tambahAtlet(Request $req){
        $validatedData = $req->validate([
            'nama' => 'required',
            "umur" => 'required',
            'otot_kaki' => 'required',
            'otot_lengan' => 'required',
            'teknik' => 'required',
            'prestasi' => 'required'
        ]);

        Athlete::create($validatedData);

        return redirect()->route('data-atlet');
    }

    public function getDataAtlet(){
        $dataAtlet = Athlete::all();

        return view('data-atlet', ['dataAtlet' => $dataAtlet]);
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
