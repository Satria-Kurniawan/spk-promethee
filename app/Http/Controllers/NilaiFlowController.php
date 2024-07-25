<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class NilaiFlowController extends Controller
{
    public function nilaiFlow()
    {
        $dataAlternatif = Alternatif::all();
        $arrayAlternatif = $dataAlternatif->toArray();

        $nilaiPreferensiKriteria = NilaiPreferensiController::hitungNilaiPreferensiKriteria($arrayAlternatif);
        $nilaiPreferensiMultikriteria = PreferensiMultiKriteriaController::hitungNilaiPreferensiMultikriteria($nilaiPreferensiKriteria);

        // $jumlahKriteria = 0;

        // foreach ($nilaiPreferensiKriteria as $prefix => $group) {
        //     foreach ($group as $key => $values) {
        //         $jumlahKriteria = count($values);
        //     }
        // }

        $jumlahAlternatif = count(Alternatif::all());

        $leavingFlow = $this->hitungLeavingFlow($nilaiPreferensiMultikriteria, $jumlahAlternatif);
        $enteringFlow = $this->hitungEnteringFlow($nilaiPreferensiMultikriteria, $jumlahAlternatif);
        $netFlow = $this->hitungNetflow($leavingFlow, $enteringFlow);


        return view('nilai-flow', [
            'nilaiPreferensiMultikriteria' => $nilaiPreferensiMultikriteria,
            'leavingFlow' => $leavingFlow,
            'enteringFlow' => $enteringFlow,
            'netFlow' => $netFlow
        ]);
    }

    public static function hitungLeavingFlow($nilaiPeferensiMultiKriteria, $jumlahAlternatif)
    {
        $sums = [];

        for ($i = 0; $i < count($nilaiPeferensiMultiKriteria); $i++) {
            $rowSum = 0;

            for ($j = 0; $j < count($nilaiPeferensiMultiKriteria); $j++) {
                $rowSum += $nilaiPeferensiMultiKriteria[$i][$j];
            }
            $sums[] = $rowSum;

            // dd(0.5 + 0.75 + 0.25 + 0.5 + 0.5 + 0.25 + 0.5 + 0.25 + 0 + 0.5 + 0.5 + 0.25 + 0.5 + 0.75 + 0.25 + 0.25);

            $hasilLeavingFlow[$i] = 1 / ($jumlahAlternatif - 1) * $sums[$i];
        }
        // dd($jumlahAlternatif);
        return $hasilLeavingFlow;
    }

    public static function hitungEnteringFlow($nilaiPeferensiMultiKriteria, $jumlahAlternatif)
    {
        $sums = [];

        for ($i = 0; $i < count($nilaiPeferensiMultiKriteria); $i++) {
            $columnSum = 0;

            for ($j = 0; $j < count($nilaiPeferensiMultiKriteria); $j++) {
                $columnSum += $nilaiPeferensiMultiKriteria[$j][$i];
            }
            $sums[] = $columnSum;

            $hasilEnteringFlow[$i] = 1 / ($jumlahAlternatif - 1) * $sums[$i];
        }

        return $hasilEnteringFlow;
    }

    public static function hitungNetflow($leavingFlow, $enteringFlow)
    {
        for ($i = 0; $i < count($leavingFlow); $i++) {
            $netFlow[$i] = $leavingFlow[$i] - $enteringFlow[$i];
        }

        return $netFlow;
    }
}
