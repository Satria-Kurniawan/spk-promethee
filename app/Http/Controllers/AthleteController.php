<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Athlete;
use App\Models\Criteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class AthleteController extends Controller
{
    public function inputAtlet(){
        $dataKriteria = Criteria::all();
        $dataSubkriteria = Subkriteria::all();

        return view('input-atlet', [
            'dataKriteria' => $dataKriteria,
            'dataSubkriteria' => $dataSubkriteria
        ]);
    }

    public function tambahAtlet(Request $req){
        $data = $req->all();

        unset($data['_token']);
        unset($data['nama']);

        $validatedData = $req->validate([
            'nama' => 'required',
        ]);

        $hasilPerankingan = $this->getDataPerankingan();
        $hasilHitungNilaiAtlet = $this->hitungNilaiAtlet($data);

        dd($hasilHitungNilaiAtlet);

        Athlete::create([
            'nama' => $validatedData['nama'],
            'data' => $data,
            'rekomendasi' => ''
        ]);

        return redirect()->back();
    }

    public static function getDataPerankingan(){
        $dataAlternatif = Alternatif::all();
        $arrayAlternatif = $dataAlternatif->toArray();

        $nilaiPreferensiKriteria = NilaiPreferensiController::hitungNilaiPreferensiKriteria($arrayAlternatif);
        $nilaiPreferensiMultikriteria = PreferensiMultiKriteriaController::hitungNilaiPreferensiMultikriteria($nilaiPreferensiKriteria);

        $jumlahKriteria = 0;

        foreach ($nilaiPreferensiKriteria as $prefix => $group) {
            foreach ($group as $key => $values) {
                $jumlahKriteria = count($values);
            }
        }

        $leavingFlow = NilaiFlowController::hitungLeavingFlow($nilaiPreferensiMultikriteria, $jumlahKriteria);
        $enteringFlow = NilaiFlowController::hitungEnteringFlow($nilaiPreferensiMultikriteria, $jumlahKriteria);
        $netFlow = NilaiFlowController::hitungNetflow($leavingFlow, $enteringFlow);

        for ($i = 0; $i < count($dataAlternatif); $i++) {
            $result[$i] = [
                'nama' => $arrayAlternatif[$i]['nama'],
                'leavingFlow' => $leavingFlow[$i],
                'enteringFlow' => $enteringFlow[$i],
                'netFlow' => $netFlow[$i]
            ];
        }

        usort($result, function ($a, $b) {
            return $b['netFlow'] <=> $a['netFlow'];
        });

        return $result;
    }

    public static function hitungNilaiAtlet($data){
        // $nilaiPreferensiKriteria = NilaiPreferensiController::hitungNilaiPreferensiKriteria($arrayAtlet);
        // $nilaiPreferensiMultikriteria = PreferensiMultiKriteriaController::hitungNilaiPreferensiMultikriteria($nilaiPreferensiKriteria);

        // $jumlahKriteria = 0;

        // foreach ($nilaiPreferensiKriteria as $prefix => $group) {
        //     foreach ($group as $key => $values) {
        //         $jumlahKriteria = count($values);
        //     }
        // }

        // $leavingFlow = NilaiFlowController::hitungLeavingFlow($nilaiPreferensiMultikriteria, $jumlahKriteria);
        // $enteringFlow = NilaiFlowController::hitungEnteringFlow($nilaiPreferensiMultikriteria, $jumlahKriteria);
        // $netFlow = NilaiFlowController::hitungNetflow($leavingFlow, $enteringFlow);

        // for ($i = 0; $i < count($dataAtlet); $i++) {
        //     $resultAtlet[$i] = [
        //         'nama' => $arrayAtlet[$i]['nama'],
        //         'leavingFlow' => $leavingFlow[$i],
        //         'enteringFlow' => $enteringFlow[$i],
        //         'netFlow' => $netFlow[$i]
        //     ];
        // }

        // usort($resultAtlet, function ($a, $b) {
        //     return $b['netFlow'] <=> $a['netFlow'];
        // });

        // return $resultAtlet;
    }

    public static function hitungNilaiPref($data){
        // $differences = [];
        // $alphabet = range('A', 'Z');

        // $nilaiPreferensiKriteria = [];

        // $kriteria = array_keys($data);

        // foreach ($arrayAlternatif as $indexA => $alternatifA) {
        //     foreach ($arrayAlternatif as $indexB => $alternatifB) {
        //         if ($indexA !== $indexB) {

        //             $differences[$indexA][$indexB] = [];

        //             foreach ($kriteria as $kriteriaKey) {
        //                 $difference = $alternatifA['data'][$kriteriaKey] - $alternatifB['data'][$kriteriaKey];
        //                 $differences[$indexA][$indexB][$kriteriaKey] = $difference;
        //             }

        //             $key = $alphabet[$indexA] . ' - ' . $alphabet[$indexB];

        //             $prefix = substr($key, 0, 1);

        //             if (!isset($nilaiPreferensiKriteria[$prefix])) {
        //                 $nilaiPreferensiKriteria[$prefix] = [];
        //             }

        //             $nilaiPreferensiKriteria[$prefix][$key] = $differences[$indexA][$indexB];
        //         }
        //     }
        // }

        // foreach ($nilaiPreferensiKriteria as $prefix => &$group) {
        //     foreach ($group as $key => &$value) {
        //         $kValues = [];

        //         foreach ($value as $k => $kValue) {
        //             $hd = 0;

        //             if($kValue <= 0){
        //                 $hd = 0;
        //             }else {
        //                 $hd = 1;
        //             }

        //             if ($k !== 'hd') {
        //                 $kValues[$k] = [
        //                     'nilai' => $kValue,
        //                     'H(d)' => $hd,
        //                 ];
        //             }
        //         }

        //         $value = $kValues;
        //     }
        // }

        // return $nilaiPreferensiKriteria;
    }
}
