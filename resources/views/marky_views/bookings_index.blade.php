@extends('layouts.marky_app')

@section('marky_content')
<div class="sm:flex sm:items-center sm:justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Active Reservations</h1>
        <p class="mt-2 text-sm text-slate-600">Overview of all booked assets, customer schedules, and documentation verification.</p>
    </div>
</div>

<div class="bg-white shadow-sm border border-slate-200 rounded-xl overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
        <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider text-xs font-semibold">
            <tr>
                <th class="px-6 py-4">Client Details</th>
                <th class="px-6 py-4">Allocated Asset</th>
                <th class="px-6 py-4">Scheduled Date</th>
                <th class="px-6 py-4">Verification Artifact</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 text-slate-700">
            @forelse($markyBookings as $booking)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-slate-900">{{ $booking->marky_customer_name }}</div>
                        <div class="text-xs text-slate-400">{{ $booking->marky_customer_email }}</div>
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-900">
                        {{ $booking->markyRoom->marky_room_name }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col space-y-1">
                            <div class="flex items-center">
                                <span class="text-[9px] font-black uppercase text-amber-600 w-12">In:</span>
                                <span class="font-mono text-xs text-slate-700">
                                    {{ \Carbon\Carbon::parse($booking->marky_check_in)->format('Y-M-d') }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-[9px] font-black uppercase text-stone-400 w-12">Out:</span>
                                <span class="font-mono text-xs text-slate-700">
                                    {{ \Carbon\Carbon::parse($booking->marky_check_out)->format('Y-M-d') }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($booking->marky_confirmation_file)
                            <a href="{{ asset('storage/' . $booking->marky_confirmation_file) }}" target="_blank" class="text-blue-600 hover:underline font-medium text-xs">View Document</a>
                        @else
                            <span class="text-slate-400 text-xs">N/A</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-1">
                            <!-- ADMIN EDIT BLUEPRINT LINK -->
                            <a href="{{ route('marky_bookings.edit', $booking->marky_booking_id) }}" class="text-xs font-black uppercase tracking-widest text-amber-600 hover:text-amber-700 mr-3">
                                Edit
                            </a>

                            <!-- SYSTEM CANCELLATION FORM BUTTON -->
                            <form action="{{ route('marky_bookings.destroy', $booking->marky_booking_id) }}" method="POST" onsubmit="return confirm('Revoke this booking item?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-900 text-xs font-semibold transition">Cancel Booking</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-sm">No reservations found in the system logs.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection