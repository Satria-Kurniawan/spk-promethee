<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class PreferensiMultiKriteriaController extends Controller
{
    public function nilaiPreferensiMultiKriteria(){
        $dataAlternatif = Alternatif::all();

        $arrayAlternatif = $dataAlternatif->toArray();

        $nilaiPreferensiKriteria = NilaiPreferensiController::hitungNilaiPreferensiKriteria($arrayAlternatif);

        $nilaiPreferensiMultikriteria = $this->hitungNilaiPreferensiMultikriteria($nilaiPreferensiKriteria);

        return view('nilai-preferensi-multikriteria', [
            'nilaiPreferensiMultikriteria' => $nilaiPreferensiMultikriteria,
        ]);
    }

    public static function hitungNilaiPreferensiMultikriteria($data)
    {
        $result = [];

        foreach ($data as $prefix => $group) {
            foreach ($group as $key => $values) {
                $prefixes = explode(" - ", $key);
                $prefix1 = $prefixes[0];
                $prefix2 = $prefixes[1];

                $keyResult = $prefix1 . ',' . $prefix2;

                $hasilPerhitunganHd = 0;

                foreach ($values as $kriteriaKey => $kriteriaValue) {
                    $hasilPerhitunganHd += $kriteriaValue["H(d)"];
                }

                $result[$prefix1][$keyResult] = 1 / count($values) * $hasilPerhitunganHd;
            }
        }

        // Konversi menjadi array 2 dimensi

        $keys = array_keys($result);
        $n = count($keys);

        $newArray = array();

        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($i == $j) {
                    $newArray[$i][$j] = null;
                } else {
                    $key = $keys[$i] . ',' . $keys[$j];
                    $newArray[$i][$j] = $result[$keys[$i]][$key];
                }
            }
        }

        return $newArray;
    }


    // public static function hitungNilaiPreferensiMultikriteria($data){
    //     dd($data);
    //     foreach ($data as $prefix => $group) {
    //         foreach ($group as $key => $values) {
    //             $prefixes = explode(" - ", $key);
    //             $prefix1 = $prefixes[0];
    //             $prefix2 = $prefixes[1];

    //             $keyResult = $prefix1 . ',' . $prefix2;

    //             $hasilPerhitunganHd = 0;

    //             foreach ($values as $key2 => $value2) {
    //                 $hasilPerhitunganHd += $value2["H(d)"];
    //             }

    //             $result[$prefix1][$keyResult] = 1/count($values) * $hasilPerhitunganHd;
    //         }

    //     }

    //     // Jadiin array 2 dimensi

    //     $keys = array_keys($result);
    //     $n = count($keys);

    //     $newArray = array();

    //     for ($i = 0; $i < $n; $i++) {
    //         for ($j = 0; $j < $n; $j++) {
    //             if ($i == $j) {
    //                 $newArray[$i][$j] = null;
    //             } else {
    //                 $key = $keys[$i] . ',' . $keys[$j];
    //                 $newArray[$i][$j] = $result[$keys[$i]][$key];
    //             }
    //         }
    //     }

    //     return $newArray;
    // }
}
