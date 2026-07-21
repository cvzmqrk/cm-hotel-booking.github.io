<?php

namespace App\Http\Controllers;

use App\Models\MarkyRoom;
use Illuminate\Http\Request;

class MarkyRoomController extends Controller
{
    public function index()
    {
        $markyRooms = MarkyRoom::all();
        return view('marky_views.rooms_index', compact('markyRooms'));
    }

    public function create()
    {
        return view('marky_views.rooms_create');
    }

    public function store(Request $request)
    {
        // Strict input validation rules with unique constraint check
        $validated = $request->validate([
            'marky_room_name' => 'required|string|max:255|unique:marky_rooms,marky_room_name',
            'marky_room_description' => 'required|string',
            'marky_room_price' => 'required|numeric|min:0',
        ]);

        // Persist data row straight to the mysql table via Eloquent
        MarkyRoom::create($validated);
        
        return redirect()->route('marky_rooms.index')->with('success', 'Room added successfully.');
    }

    public function show(MarkyRoom $markyRoom)
    {
        return view('marky_views.rooms_show', compact('markyRoom'));
    }

    public function edit(MarkyRoom $markyRoom)
    {
        return view('marky_views.rooms_edit', compact('markyRoom'));
    }

    public function update(Request $request, MarkyRoom $markyRoom)
    {
        $validated = $request->validate([
            'marky_room_name' => 'required|string|max:255',
            'marky_room_description' => 'required|string',
            'marky_room_price' => 'required|numeric|min:0',
        ]);

        $markyRoom->update($validated);
        return redirect()->route('marky_rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(MarkyRoom $markyRoom)
    {
        $markyRoom->delete();
        return redirect()->route('marky_rooms.index')->with('success', 'Room deleted successfully.');
    }
}