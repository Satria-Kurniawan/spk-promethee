<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class NilaiFlowController extends Controller
{
    public function nilaiFlow(){
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

        $leavingFlow = $this->hitungLeavingFlow($nilaiPreferensiMultikriteria, $jumlahKriteria);
        $enteringFlow = $this->hitungEnteringFlow($nilaiPreferensiMultikriteria, $jumlahKriteria);
        $netFlow = $this->hitungNetflow($leavingFlow, $enteringFlow);


        return view('nilai-flow', [
            'nilaiPreferensiMultikriteria' => $nilaiPreferensiMultikriteria,
            'leavingFlow' => $leavingFlow,
            'enteringFlow' => $enteringFlow,
            'netFlow' => $netFlow
        ]);
    }

    public static function hitungLeavingFlow($nilaiPeferensiMultiKriteria, $jumlahKriteria){
        $sums = [];

        for ($i = 0; $i < count($nilaiPeferensiMultiKriteria); $i++) {
            $rowSum = 0;

            for ($j = 0; $j < count($nilaiPeferensiMultiKriteria); $j++) {
                $rowSum += $nilaiPeferensiMultiKriteria[$i][$j];
            }
            $sums[] = $rowSum;

            $hasilLeavingFlow[$i] = 1/($jumlahKriteria - 1) * $sums[$i];
        }

        return $hasilLeavingFlow;
    }

    public static function hitungEnteringFlow($nilaiPeferensiMultiKriteria, $jumlahKriteria){
        $sums = [];

        for ($i = 0; $i < count($nilaiPeferensiMultiKriteria); $i++) {
            $columnSum = 0;

            for ($j = 0; $j < count($nilaiPeferensiMultiKriteria); $j++) {
                $columnSum += $nilaiPeferensiMultiKriteria[$j][$i];
            }
            $sums[] = $columnSum;

            $hasilEnteringFlow[$i] = 1/($jumlahKriteria - 1) * $sums[$i];
        }

        return $hasilEnteringFlow;
    }

    public static function hitungNetflow($leavingFlow, $enteringFlow){
        for ($i=0; $i < count($leavingFlow) ; $i++) {
            $netFlow[$i] = $leavingFlow[$i] - $enteringFlow[$i];
        }

        return $netFlow;
    }
}
