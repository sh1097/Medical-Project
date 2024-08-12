<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\Slot;

class SlotController extends Controller
{
    /**
     * Show the form for creating a new slot.
     *
     * @param  int  $clinicId
     * @return \Illuminate\Http\Response
     */
    public function create($clinicId)
    {
        
        $clinic = Clinic::findOrFail($clinicId);
      
        return view('slots.create', compact('clinic'));
    }

    /**
     * Store a newly created slot for the clinic.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $clinicId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $clinicId)
    {
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            // Add more validation rules as needed
        ]);

        $clinic = Clinic::findOrFail($clinicId);

        $slot = new Slot();
        $slot->clinic_id = $clinic->id;
        $slot->start_time = $request->input('start_time');
        $slot->end_time = $request->input('end_time');
        // Add more fields as needed

        $slot->save();

        return redirect()->route('clinics.show', $clinic->id)->with('success', 'Slot added successfully.');
    }

    /**
     * Show the form for editing the specified slot.
     *
     * @param  int  $clinicId
     * @param  int  $slotId
     * @return \Illuminate\Http\Response
     */
    public function edit($clinicId, $slotId)
    {
        $clinic = Clinic::findOrFail($clinicId);
        $slot = Slot::findOrFail($slotId);

        return view('slots.edit', compact('clinic', 'slot'));
    }

    /**
     * Update the specified slot in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $clinicId
     * @param  int  $slotId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clinicId, $slotId)
    {
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            // Add more validation rules as needed
        ]);

        $clinic = Clinic::findOrFail($clinicId);
        $slot = Slot::findOrFail($slotId);
        $slot->start_time = $request->input('start_time');
        $slot->end_time = $request->input('end_time');
        // Update more fields as needed

        $slot->save();

        return redirect()->route('clinics.show', $clinic->id)->with('success', 'Slot updated successfully.');
    }

    /**
     * Remove the specified slot from storage.
     *
     * @param  int  $clinicId
     * @param  int  $slotId
     * @return \Illuminate\Http\Response
     */
    public function destroy($clinicId, $slotId)
    {
        $clinic = Clinic::findOrFail($clinicId);
        $slot = Slot::findOrFail($slotId);
        $slot->delete();

        return redirect()->route('clinics.show', $clinic->id)->with('success', 'Slot deleted successfully.');
    }

public function show($clinicId)
{
    $clinic = Clinic::findOrFail($clinicId);
    return view('clinics.show', compact('clinic'));
}

}
