<?php
namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\Ward;
use App\Models\PollingUnit;
use App\Models\AnnouncedPuResult;
use Illuminate\Http\Request;

class PollingUnitController extends Controller
{
    public function index()
    {
        $lgas = Lga::where('state_id', 25)->get();
        return view('polling-unit.index', compact('lgas'));
    }

    public function getWards($lga_id)
    {
        $wards = Ward::where('lga_id', $lga_id)->get();
        return response()->json($wards);
    }

    public function getPollingUnits(Request $request, $ward_id)
    {
        $lga_id = $request->query('lga_id');
        $pollingUnits = PollingUnit::where('ward_id', $ward_id)->where('lga_id', $lga_id)->get();
        return response()->json($pollingUnits);
    }

    public function getResults(Request $request, $polling_unit_id)
    {
        $ward_id = $request->query('ward_id');
        $lga_id = $request->query('lga_id');
        $pollingUnit = PollingUnit::where('polling_unit_id', $polling_unit_id)->where('ward_id', $ward_id)->where('lga_id', $lga_id)->first();

        if ($pollingUnit) {
            $results = AnnouncedPuResult::where('polling_unit_uniqueid', $polling_unit_id)->get();
            return response()->json($results);
        }

        return response()->json(['error' => 'Polling unit not found'], 404);
    }
}
