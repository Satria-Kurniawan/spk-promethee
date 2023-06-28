<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use Illuminate\Http\Request;

class NilaiPreferensiController extends Controller
{
    public function nilaiPreferensiKriteria(){
        $dataAtlet = Athlete::all();

        $arrayAtlet = $dataAtlet->toArray();

        $nilaiPreferensiKriteria = $this->hitungNilaiPreferensiKriteria($arrayAtlet);

        return view('nilai-preferensi-kriteria', [
            'dataAtlet' => $dataAtlet,
            'nilaiPreferensiKriteria'=>$nilaiPreferensiKriteria
        ]);
    }

    public static function hitungNilaiPreferensiKriteria($arrayAtlet){
        $differences = [];
        $alphabet = range('A', 'Z');

        $nilaiPreferensiKriteria = [];

        foreach ($arrayAtlet as $indexA => $atletA) {
            foreach ($arrayAtlet as $indexB => $atletB) {
                if ($indexA !== $indexB) {
                    $umurDifference = $atletA['umur'] - $atletB['umur'];
                    $ototKakiDifference = $atletA['otot_kaki'] - $atletB['otot_kaki'];
                    $ototLenganDifference = $atletA['otot_lengan'] - $atletB['otot_lengan'];
                    $teknikDifference = $atletA['teknik'] - $atletB['teknik'];
                    $prestasiDifference = $atletA['prestasi'] - $atletB['prestasi'];

                    $key = $alphabet[$indexA] . ' - ' . $alphabet[$indexB];

                    $differences[$key] = [
                        'K1' => $umurDifference,
                        'K2' => $ototKakiDifference,
                        'K3' => $ototLenganDifference,
                        'K4' => $teknikDifference,
                        'K5' => $prestasiDifference,
                    ];

                    $prefix = substr($key, 0, 1);

                    if (!isset($nilaiPreferensiKriteria[$prefix])) {
                        $nilaiPreferensiKriteria[$prefix] = [];
                    }

                    $nilaiPreferensiKriteria[$prefix][$key] = $differences[$key];
                }
            }
        }

        foreach ($nilaiPreferensiKriteria as $prefix => &$group) {
            foreach ($group as $key => &$value) {
                $kValues = [];

                foreach ($value as $k => $kValue) {
                    $hd = 0;

                    if($kValue <= 0){
                        $hd = 0;
                    }else {
                        $hd = 1;
                    }

                    if ($k !== 'hd') {
                        $kValues[$k] = [
                            'nilai' => $kValue,
                            'H(d)' => $hd,
                        ];
                    }
                }

                $value = $kValues;
            }
        }

        return $nilaiPreferensiKriteria;
    }
}


