@extends('layouts.marky_app')

@section('marky_content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="bg-white border border-stone-200 rounded-2xl p-6 shadow-sm">
        <h2 class="text-xl font-black text-stone-900 tracking-tight mb-6">Modify Booking Blueprint Record</h2>

        <form action="{{ route('marky_bookings.update', $markyBooking->marky_booking_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-stone-500 mb-2">Target Room/Asset</label>
                    <select name="marky_room_id" class="w-full border-stone-200 rounded-xl shadow-sm focus:ring-amber-500 focus:border-amber-500 text-sm">
                        @foreach($markyRooms as $room)
                            <option value="{{ $room->marky_room_id }}" {{ $markyBooking->marky_room_id == $room->marky_room_id ? 'selected' : '' }}>
                                {{ $room->marky_room_name }} (₱{{ $room->marky_room_price }}/night)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-stone-500 mb-2">Customer Full Name</label>
                    <input type="text" name="marky_customer_name" value="{{ old('marky_customer_name', $markyBooking->marky_customer_name) }}" class="w-full border-stone-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-stone-500 mb-2">Email Address</label>
                    <input type="email" name="marky_customer_email" value="{{ old('marky_customer_email', $markyBooking->marky_customer_email) }}" class="w-full border-stone-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-stone-500 mb-2">Check-in Date</label>
                        <input type="date" name="marky_check_in" value="{{ old('marky_check_in', \Carbon\Carbon::parse($markyBooking->marky_check_in)->format('Y-m-d')) }}" class="w-full border-stone-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-stone-500 mb-2">Check-out Date</label>
                        <input type="date" name="marky_check_out" value="{{ old('marky_check_out', \Carbon\Carbon::parse($markyBooking->marky_check_out)->format('Y-m-d')) }}" class="w-full border-stone-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t border-stone-100">
                <a href="{{ route('marky_bookings.index') }}" class="text-xs font-black uppercase tracking-widest text-stone-400 hover:text-stone-600 transition">Cancel</a>
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-neutral-950 font-black text-xs uppercase tracking-widest px-5 py-3 rounded-xl transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection