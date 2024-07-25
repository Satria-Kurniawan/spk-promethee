<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Criteria;
use Illuminate\Http\Request;

class NilaiPreferensiController extends Controller
{
    public function nilaiPreferensiKriteria()
    {
        $dataAlternatif = Alternatif::all();
        $dataKriteria = Criteria::all();

        $arrayAlternatif = $dataAlternatif->toArray();

        $nilaiPreferensiKriteria = $this->hitungNilaiPreferensiKriteria($arrayAlternatif);

        return view('nilai-preferensi-kriteria', [
            'dataAlternatif' => $dataAlternatif,
            'nilaiPreferensiKriteria' => $nilaiPreferensiKriteria,
            'dataKriteria' => $dataKriteria
        ]);
    }

    public static function BACKUP_hitungNilaiPreferensiKriteria($arrayAlternatif)
    {
        $differences = [];
        $alphabet = range('A', 'Z');

        $nilaiPreferensiKriteria = [];

        $kriteria = array_keys($arrayAlternatif[0]['data']);

        foreach ($arrayAlternatif as $indexA => $alternatifA) {
            foreach ($arrayAlternatif as $indexB => $alternatifB) {
                if ($indexA !== $indexB) {

                    $differences[$indexA][$indexB] = [];

                    foreach ($kriteria as $kriteriaKey) {
                        $difference = $alternatifA['data'][$kriteriaKey] - $alternatifB['data'][$kriteriaKey];
                        $differences[$indexA][$indexB][$kriteriaKey] = $difference;
                    }

                    $key = $alphabet[$indexA] . ' - ' . $alphabet[$indexB];

                    // $differences[$key] = [
                    //     'K1' => $umurDifference,
                    //     'K2' => $ototKakiDifference,
                    //     'K3' => $ototLenganDifference,
                    //     'K4' => $teknikDifference,
                    //     'K5' => $prestasiDifference,
                    // ];

                    $prefix = substr($key, 0, 1);

                    if (!isset($nilaiPreferensiKriteria[$prefix])) {
                        $nilaiPreferensiKriteria[$prefix] = [];
                    }

                    $nilaiPreferensiKriteria[$prefix][$key] = $differences[$indexA][$indexB];
                }
            }
        }

        // dd($nilaiPreferensiKriteria);

        // foreach ($arrayAlternatif as $indexA => $alternatifA) {
        //     foreach ($arrayAlternatif as $indexB => $alternatifB) {
        //         if ($indexA !== $indexB) {
        //             $umurDifference = $alternatifA['umur'] - $alternatifB['umur'];
        //             $ototKakiDifference = $alternatifA['otot_kaki'] - $alternatifB['otot_kaki'];
        //             $ototLenganDifference = $alternatifA['otot_lengan'] - $alternatifB['otot_lengan'];
        //             $teknikDifference = $alternatifA['teknik'] - $alternatifB['teknik'];
        //             $prestasiDifference = $alternatifA['prestasi'] - $alternatifB['prestasi'];

        //             $key = $alphabet[$indexA] . ' - ' . $alphabet[$indexB];

        //             $differences[$key] = [
        //                 'K1' => $umurDifference,
        //                 'K2' => $ototKakiDifference,
        //                 'K3' => $ototLenganDifference,
        //                 'K4' => $teknikDifference,
        //                 'K5' => $prestasiDifference,
        //             ];

        //             $prefix = substr($key, 0, 1);

        //             if (!isset($nilaiPreferensiKriteria[$prefix])) {
        //                 $nilaiPreferensiKriteria[$prefix] = [];
        //             }

        //             $nilaiPreferensiKriteria[$prefix][$key] = $differences[$key];
        //         }
        //     }
        // }

        foreach ($nilaiPreferensiKriteria as $prefix => &$group) {
            foreach ($group as $key => &$value) {
                $kValues = [];

                foreach ($value as $k => $kValue) {
                    $hd = 0;

                    if ($kValue <= 0) {
                        $hd = 0;
                    } else {
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

    public static function hitungNilaiPreferensiKriteria($arrayAlternatif)
    {
        $differences = [];
        $alphabet = array_map(function ($index) {
            return 'A' . ($index + 1);
        }, array_keys($arrayAlternatif));

        $nilaiPreferensiKriteria = [];

        $kriteria = array_keys($arrayAlternatif[0]['data']);

        foreach ($arrayAlternatif as $indexA => $alternatifA) {
            foreach ($arrayAlternatif as $indexB => $alternatifB) {
                if ($indexA !== $indexB) {

                    $differences[$indexA][$indexB] = [];

                    foreach ($kriteria as $kriteriaKey) {
                        $difference = $alternatifA['data'][$kriteriaKey] - $alternatifB['data'][$kriteriaKey];
                        $differences[$indexA][$indexB][$kriteriaKey] = $difference;
                    }

                    $key = $alphabet[$indexA] . ' - ' . $alphabet[$indexB];

                    $prefix = substr($key, 0, 2);

                    if (!isset($nilaiPreferensiKriteria[$prefix])) {
                        $nilaiPreferensiKriteria[$prefix] = [];
                    }

                    $nilaiPreferensiKriteria[$prefix][$key] = $differences[$indexA][$indexB];
                }
            }
        }

        foreach ($nilaiPreferensiKriteria as $prefix => &$group) {
            foreach ($group as $key => &$value) {
                $kValues = [];

                foreach ($value as $k => $kValue) {
                    $hd = 0;

                    if ($kValue <= 0) {
                        $hd = 0;
                    } else {
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
