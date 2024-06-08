<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\PollingUnit;
use App\Models\AnnouncedPuResult;
use Illuminate\Http\Request;


class LgaCountController extends Controller
{
    public function lgaSummary()
    {
        $lgas = Lga::where('state_id', 25)->get();
        return view('polling-unit.lga-summary', compact('lgas'));
    }

    public function getLgaSummary($lga_id)
    {
        $pollingUnits = PollingUnit::where('lga_id', $lga_id)->pluck('polling_unit_id');
        $results = AnnouncedPuResult::whereIn('polling_unit_uniqueid', $pollingUnits)->get();

        $summary = $results->groupBy('party_abbreviation')->map(function ($group) {
            return $group->sum('party_score');
        });

        return response()->json($summary);
    }
}
