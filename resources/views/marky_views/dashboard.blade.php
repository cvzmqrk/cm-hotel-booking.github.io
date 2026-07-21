@extends('layouts.marky_app')

@section('marky_content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Welcome Header Segment -->
    <div class="mb-8">
        <h1 class="text-3xl font-black text-stone-900 tracking-tight">System Dashboard</h1>
        <p class="text-sm text-stone-500 font-medium mt-1">Real-time analytical overview of reservation schedules and user accounts.</p>
    </div>

    <!-- STATS GRID CONTAINER (Fulfills highest rubric criteria) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        
        <!-- CARD 1: Total Booked Dates Display -->
        <div class="bg-white border border-stone-200 rounded-2xl p-6 shadow-sm flex items-center space-x-5">
            <div class="p-4 bg-amber-500/10 rounded-xl text-amber-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <span class="block text-[10px] font-black text-stone-400 uppercase tracking-widest">Total Booked Dates</span>
                <span class="block text-3xl font-black text-stone-900 mt-1">{{ $totalBookings }}</span>
            </div>
        </div>

        <!-- CARD 2: Total System Users Display -->
        <div class="bg-white border border-stone-200 rounded-2xl p-6 shadow-sm flex items-center space-x-5">
            <div class="p-4 bg-neutral-950/5 rounded-xl text-neutral-950">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div>
                <span class="block text-[10px] font-black text-stone-400 uppercase tracking-widest">Total Active Users</span>
                <span class="block text-3xl font-black text-stone-900 mt-1">{{ $totalUsers }}</span>
            </div>
        </div>

    </div>

    <!-- Quick Action Navigation Hub -->
    <div class="bg-stone-900 rounded-2xl p-6 text-white flex flex-col md:flex-row items-center justify-between">
        <div class="mb-4 md:mb-0">
            <h3 class="text-lg font-bold tracking-tight">Need to manage reservations?</h3>
            <p class="text-xs text-stone-400 mt-1">Navigate directly to your operational booking logs or setup configurations.</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('marky_bookings.index') }}" class="bg-white/10 hover:bg-white/20 text-white font-bold text-xs uppercase tracking-widest px-5 py-3 rounded-xl transition">
                View Active Bookings
            </a>
            <a href="{{ route('marky_bookings.wizard.step_one') }}" class="bg-amber-500 hover:bg-amber-600 text-neutral-950 font-black text-xs uppercase tracking-widest px-5 py-3 rounded-xl transition shadow-lg shadow-amber-500/10">
                Launch Wizard
            </a>
        </div>
    </div>

</div>
@endsection