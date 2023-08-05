<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class PerankinganController extends Controller
{
    public function perankingan(){
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

        return view('perankingan', [
            'hasilPerankingan' => $result
        ]);
    }
}
