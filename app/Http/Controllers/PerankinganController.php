<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use Illuminate\Http\Request;

class PerankinganController extends Controller
{
    public function perankingan(){
        $dataAtlet = Athlete::all();
        $arrayAtlet = $dataAtlet->toArray();

        $nilaiPreferensiKriteria = NilaiPreferensiController::hitungNilaiPreferensiKriteria($arrayAtlet);
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

        for ($i = 0; $i < count($dataAtlet); $i++) {
            $result[$i] = [
                'nama' => $arrayAtlet[$i]['nama'],
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
