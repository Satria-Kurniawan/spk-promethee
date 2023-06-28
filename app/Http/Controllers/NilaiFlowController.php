<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use Illuminate\Http\Request;

class NilaiFlowController extends Controller
{
    public function nilaiFlow(){
        $dataAtlet = Athlete::all();
        $arrayAtlet = $dataAtlet->toArray();

        $nilaiPreferensiKriteria = NilaiPreferensiController::hitungNilaiPreferensiKriteria($arrayAtlet);
        $nilaiPeferensiMultiKriteria = PreferensiMultiKriteriaController::hitungNilaiPreferensiMultikriteria($nilaiPreferensiKriteria);

        $jumlahKriteria = 0;

        foreach ($nilaiPreferensiKriteria as $prefix => $group) {
            foreach ($group as $key => $values) {
                $jumlahKriteria = count($values);
            }
        }

        $leavingFlow = $this->hitungLeavingFlow($nilaiPeferensiMultiKriteria, $jumlahKriteria);
        $enteringFlow = $this->hitungEnteringFlow($nilaiPeferensiMultiKriteria, $jumlahKriteria);

        dd($leavingFlow, $enteringFlow);

        return view('nilai-flow');
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
}
