<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return Guest::with('event')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string',
            'email' => 'nullable|email',
            'tag' => 'required|in:family,friend,colleague',
        ]);

        return Guest::create($validated);
    }

    public function show(Guest $guest)
    {
        return $guest->load('event');
    }

    public function update(Request $request, Guest $guest)
    {
        $guest->update($request->all());
        return response()->json(['message' => 'Guest updated successfully', 'guest' => $guest]);
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json(['message' => 'Guest deleted successfully']);
    }

    public function getGuestsByEvent($event_id)
    {
        return Guest::where('event_id', $event_id)->get();
    }
}
