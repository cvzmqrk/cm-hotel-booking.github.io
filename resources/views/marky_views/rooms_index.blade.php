@extends('layouts.marky_app')

@section('marky_content')
<div class="sm:flex sm:items-center sm:justify-between mb-8 bg-neutral-950 p-6 rounded-2xl border border-stone-800 shadow-md">
    <div>
        <h1 class="text-2xl font-black text-white tracking-tight">Available Rooms & Assets</h1>
        <p class="mt-1 text-sm text-stone-400">Browse and manage active corporate locations, premium spaces, and global inventory configurations.</p>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="{{ route('marky_rooms.create') }}" class="inline-flex items-center justify-center rounded-xl bg-amber-500 px-5 py-3 text-sm font-bold text-neutral-950 shadow-lg shadow-amber-500/10 hover:bg-amber-400 transition transform active:scale-95">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
            Add New Asset Room
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold rounded-xl flex items-center">
    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-3 animate-pulse"></span>
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl border border-stone-200 shadow-xl overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-neutral-950 text-[11px] font-bold uppercase tracking-widest text-amber-500 border-b border-stone-800">
                <th class="py-4 px-6">Room ID</th>
                <th class="py-4 px-6">Asset Name</th>
                <th class="py-4 px-6">Description Manifest</th>
                <th class="py-4 px-6">Daily Cost</th>
                <th class="py-4 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100 text-sm text-stone-800">
            @foreach($markyRooms as $room)
            <tr class="hover:bg-stone-50/50 transition">
                <td class="py-4 px-6 text-stone-400 font-mono">#{{ $room->marky_room_id }}</td>
                <td class="py-4 px-6 font-bold text-neutral-900">{{ $room->marky_room_name }}</td>
                <td class="py-4 px-6 text-stone-500 max-w-xs truncate">{{ $room->marky_room_description }}</td>
                <td class="py-4 px-6 font-bold text-neutral-900 font-mono">
                    ₱{{ number_format($room->marky_room_price, 2) }}
                </td>
                <td class="py-4 px-6 text-center">
                    <a href="{{ route('marky_rooms.edit', $room->marky_room_id) }}" class="inline-flex items-center space-x-1.5 bg-neutral-900 hover:bg-amber-500 text-white hover:text-neutral-950 font-bold text-xs py-2 px-4 rounded-lg shadow-sm transition duration-150">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                        </svg>
                        <span>Edit Space</span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection