@extends('layouts.marky_app')

@section('marky_content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl text-xs font-black text-emerald-800 uppercase tracking-wide">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-8">
        <h1 class="text-3xl font-black text-stone-900 tracking-tight">Welcome to your Portal, {{ Auth::user()->name }}</h1>
        <p class="text-sm text-stone-500 font-medium mt-1">Easily configure personal reservation timelines or review schedules below.</p>
    </div>

    <!-- USER SPECIFIC IMPORTANT ANALYTICS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white border border-stone-200 rounded-2xl p-6 shadow-sm flex items-center space-x-5">
            <div class="p-4 bg-amber-500/10 rounded-xl text-amber-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <span class="block text-[10px] font-black text-stone-400 uppercase tracking-widest">My Active Bookings</span>
                <span class="block text-3xl font-black text-stone-900 mt-1">{{ $totalBookings }}</span>
            </div>
        </div>
    </div>

    <!-- EXCLUSIVE PERSONAL RESERVATIONS LIST GRID -->
    <div class="mb-8 bg-white border border-stone-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="px-6 py-4 border-b border-stone-100 bg-stone-50/50">
            <h3 class="text-xs font-black text-stone-900 uppercase tracking-wider">My Confirmed Allocations</h3>
        </div>
        
        <table class="min-w-full divide-y divide-stone-200 text-left text-xs">
            <thead class="bg-stone-50 text-stone-400 uppercase tracking-widest font-black text-[10px]">
                <tr>
                    <th class="px-6 py-4">Allocated Asset</th>
                    <th class="px-6 py-4">Check-In</th>
                    <th class="px-6 py-4">Check-Out</th>
                    <th class="px-6 py-4">Pricing Layout</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-200 text-stone-700 font-medium">
                @forelse(\App\Models\MarkyBooking::where('marky_customer_email', Auth::user()->email)->get() as $myBooking)
                    <tr class="hover:bg-stone-50/60 transition">
                        <td class="px-6 py-4 font-bold text-stone-900">
                            {{ $myBooking->markyRoom->marky_room_name ?? 'Premium Space' }}
                        </td>
                        <td class="px-6 py-4 font-mono">
                            {{ \Carbon\Carbon::parse($myBooking->marky_check_in)->format('Y-M-d') }}
                        </td>
                        <td class="px-6 py-4 font-mono">
                            {{ \Carbon\Carbon::parse($myBooking->marky_check_out)->format('Y-M-d') }}
                        </td>
                        <td class="px-6 py-4 font-bold text-stone-900">
                            ₱{{ number_format($myBooking->marky_total_price, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-stone-400">You have no active room schedules reserved currently.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-stone-900 rounded-2xl p-6 text-white flex flex-col md:flex-row items-center justify-between">
        <div>
            <h3 class="text-lg font-bold tracking-tight">Ready to create another reservation?</h3>
            <p class="text-xs text-stone-400 mt-1">Launch our interactive date picker panel wizard to select your schedule allocation.</p>
        </div>
        <a href="{{ route('marky_bookings.wizard.step_one') }}" class="bg-amber-500 hover:bg-amber-600 text-neutral-950 font-black text-xs uppercase tracking-widest px-5 py-3 rounded-xl transition mt-4 md:mt-0">
            Launch Wizard Panel
        </a>
    </div>

</div>
@endsection