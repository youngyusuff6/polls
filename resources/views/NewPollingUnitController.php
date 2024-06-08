<?php 

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\Ward;
use App\Models\PollingUnit;
use App\Models\AnnouncedPuResult;
use Illuminate\Http\Request;

class NewPollingUnitController extends Controller
{

    public function create()
    {
        $lgas = Lga::where('state_id', 25)->get();
        return view('polling-unit.create', compact('lgas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'polling_unit_id' => 'required|string',
            'ward_id' => 'required|integer',
            'lga_id' => 'required|integer',
            'polling_unit_number' => 'required|string',
            'polling_unit_name' => 'required|string',
            'polling_unit_description' => 'nullable|string',
            'entered_by_user' => 'required|string',
            'user_ip_address' => 'required|string',
            'results' => 'required|array',
            'results.*.party_abbreviation' => 'required|string|max:4',
            'results.*.party_score' => 'required|integer',
        ]);

        $pollingUnit = PollingUnit::create([
            'polling_unit_id' => $validatedData['polling_unit_id'],
            'ward_id' => $validatedData['ward_id'],
            'lga_id' => $validatedData['lga_id'],
            'polling_unit_number' => 'DT'.$validatedData['polling_unit_number'],
            'polling_unit_name' => $validatedData['polling_unit_name'],
            'polling_unit_description' => $validatedData['polling_unit_description'],
            'entered_by_user' => $validatedData['entered_by_user'],
            'user_ip_address' => $validatedData['user_ip_address'],
        ]);

        foreach ($validatedData['results'] as $result) {
            AnnouncedPuResult::create([
                'polling_unit_uniqueid' => $pollingUnit->polling_unit_id,
                'party_abbreviation' => $result['party_abbreviation'],
                'party_score' => $result['party_score'],
                'entered_by_user' => $validatedData['entered_by_user'],
                'date_entered' => now(),
                'user_ip_address' => $validatedData['user_ip_address'],
            ]);
        }

        return redirect()->route('new-polling-unit.create')->with('success', 'Polling Unit and Results added successfully!');
    }
}
