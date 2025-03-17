<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        return Vendor::with('event')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string',
            'category' => 'required|string',
            'contact' => 'nullable|string',
        ]);

        return Vendor::create($validated);
    }

    public function show(Vendor $vendor)
    {
        return $vendor->load('event');
    }

    public function update(Request $request, Vendor $vendor)
    {
        $vendor->update($request->all());
        return response()->json(['message' => 'Vendor updated successfully', 'vendor' => $vendor]);
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return response()->json(['message' => 'Vendor deleted successfully']);
    }

    public function getVendorsByEvent($event_id)
    {
        return Vendor::where('event_id', $event_id)->get();
    }
}

