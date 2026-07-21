@extends('layouts.marky_app')

@section('marky_content')
<!-- Inject FullCalendar 6 Core Asset Modules via fast Cloudflare CDNs -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<div class="w-full flex flex-col lg:flex-row items-start gap-8 py-4">
    
    <!-- LEFT SIDE: Full Visual Schedule Calendar Grid Map -->
    <div class="w-full lg:w-3/5 bg-white border border-stone-200/60 rounded-3xl p-6 shadow-xl shadow-stone-200/30">
        <div class="mb-4">
            <h2 class="text-lg font-black text-neutral-950 tracking-tight uppercase">Room Availability Grid</h2>
            <p class="text-stone-500 text-xs">Click a single day OR **click and drag your mouse across multiple days** to extend your stay.</p>
        </div>
        <!-- Calendar Mount Target DOM anchor node -->
        <div id="marky_event_calendar" class="p-2 font-sans bg-stone-50 rounded-2xl border border-stone-100 min-h-[480px]"></div>
    </div>

    <!-- RIGHT SIDE: Parameter Configuration Submission Form -->
    <div class="w-full lg:w-2/5 flex flex-col items-center">
        <span class="bg-neutral-950 text-amber-500 font-black text-[10px] uppercase tracking-widest px-3 py-1 rounded-full mb-3 shadow-sm self-start">
            Step 1 of 3
        </span>

        <h1 class="text-neutral-950 font-black text-2xl tracking-tight self-start mb-1">
            Primary Configuration
        </h1>
        <p class="text-stone-500 text-xs font-medium tracking-wide self-start mb-6">
            Dates are non-editable text forms. Highlight or click a date range directly inside the calendar layout grid.
        </p>

        <div class="bg-white border border-stone-200/60 rounded-3xl p-6 w-full shadow-xl shadow-stone-200/40">
            
            @if ($errors->any())
                <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl flex items-start space-x-3">
                    <div>
                        <h4 class="text-xs font-black text-red-800 uppercase tracking-wide mb-1">Validation Failure</h4>
                        <ul class="list-disc list-inside text-[11px] text-red-700 space-y-0.5 font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('marky_bookings.wizard.step_one.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Target Room Selection -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-stone-500 mb-1.5">
                        Select Target Asset/Room
                    </label>
                    <select id="marky_room_id" name="marky_room_id" 
                        class="w-full bg-stone-50 border @error('marky_room_id') border-red-400 @else border-stone-200 @enderror text-stone-800 text-xs font-bold px-4 py-3.5 rounded-xl focus:outline-none focus:border-amber-500 transition">
                        <option value="" disabled {{ old('marky_room_id', $markySessionData['marky_room_id'] ?? '') == '' ? 'selected' : '' }}>
                            Choose a premium space location...
                        </option>
                        @foreach($markyRooms as $room)
                            <option value="{{ $room->marky_room_id }}" {{ old('marky_room_id', $markySessionData['marky_room_id'] ?? '') == $room->marky_room_id ? 'selected' : '' }}>
                                {{ $room->marky_room_name }} (₱{{ number_format($room->marky_room_price, 2) }}/night)
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Customer Name Profile Configuration -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-stone-500 mb-1.5">
                        Customer Full Name
                    </label>
                    <input type="text" id="marky_customer_name" name="marky_customer_name" 
                        placeholder="e.g., John Doe" 
                        value="{{ old('marky_customer_name', Auth::user()->name) }}"
                        class="w-full bg-stone-50 border @error('marky_customer_name') border-red-400 @else border-stone-200 @enderror text-stone-800 text-xs font-bold px-4 py-3.5 rounded-xl focus:outline-none focus:border-amber-500 transition">
                </div>

                <!-- Electronic Routing Email Contact -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-stone-500 mb-1.5">
                        Email Address
                    </label>
                    <input type="email" id="marky_customer_email" name="marky_customer_email" 
                        placeholder="e.g., customer@hotelcm.com" 
                        value="{{ old('marky_customer_email', Auth::user()->email) }}"
                        class="w-full bg-stone-50 border @error('marky_customer_email') border-red-400 @else border-stone-200 @enderror text-stone-800 text-xs font-bold px-4 py-3.5 rounded-xl focus:outline-none focus:border-amber-500 transition">
                </div>

                <!-- Date Range Form Elements -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-stone-500 mb-1.5">
                            Check-In Date
                        </label>
                        <input type="text" id="marky_check_in" name="marky_check_in" readonly
                            placeholder="Click grid date..."
                            value="{{ old('marky_check_in', $markySessionData['marky_check_in'] ?? '') }}"
                            class="w-full bg-stone-100 border border-stone-200 text-neutral-950 font-mono text-xs font-bold px-4 py-3.5 rounded-xl cursor-not-allowed outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-stone-500 mb-1.5">
                            Check-Out Date
                        </label>
                        <input type="text" id="marky_check_out" name="marky_check_out" readonly
                            placeholder="Drag select range..."
                            value="{{ old('marky_check_out', $markySessionData['marky_check_out'] ?? '') }}"
                            class="w-full bg-stone-100 border border-stone-200 text-neutral-950 font-mono text-xs font-bold px-4 py-3.5 rounded-xl cursor-not-allowed outline-none">
                    </div>
                </div>

                <button type="submit" 
                    class="w-full bg-neutral-950 hover:bg-neutral-900 text-amber-500 text-xs font-black uppercase tracking-widest py-4 rounded-xl transition duration-200 shadow-md transform active:scale-[0.99] mt-2">
                    Continue to Verification
                </button>
            </form>
        </div>
    </div>
</div>

<!-- FRONT-END INTERACTIVE INTERPRETATION ENGINE SCRIPT -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('marky_event_calendar');
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            selectMirror: true,
            unselectAuto: false, // Prevents selection from instantly resetting
            selectOverlap: true, // Allows dragging selection parameters cleanly
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            events: "{{ route('api.marky_bookings.dates') }}",
            
            select: function(info) {
                var checkInInput = document.getElementById('marky_check_in');
                var checkOutInput = document.getElementById('marky_check_out');
                
                // Set the initial check-in string date
                checkInInput.value = info.startStr;
                
                // Break down dates natively using exact UTC calculations
                var dStart = new Date(info.start.getTime());
                var dEnd = new Date(info.end.getTime());
                
                var diffMs = dEnd - dStart;
                var diffDays = Math.round(diffMs / (1000 * 60 * 60 * 24));
                
                if (diffDays <= 1) {
                    // Single day box click: increment exact next calendar string day manually
                    var singleCheckOut = new Date(dStart);
                    singleCheckOut.setDate(singleCheckOut.getDate() + 1);
                    checkOutInput.value = singleCheckOut.toISOString().split('T')[0];
                } else {
                    // Click and drag range selection: drop FullCalendar endStr value directly
                    checkOutInput.value = info.endStr;
                }
            }
        });
        
        calendar.render();
    });
</script>

<style>
    .fc .fc-button-primary { background-color: #0a0a0a !important; border-color: transparent !important; font-size: 10px !important; font-weight: 900 !important; text-transform: uppercase !important; letter-spacing: 0.05em !important; border-radius: 8px !important; }
    .fc .fc-button-primary:hover { background-color: #d97706 !important; color: #0a0a0a !important; }
    .fc .fc-toolbar-title { font-size: 14px !important; font-weight: 900 !important; text-transform: uppercase; letter-spacing: -0.025em; color: #0a0a0a; }
    .fc-theme-standard td, .fc-theme-standard th { border-color: #f5f5f4 !important; font-size: 11px !important; }
    .fc .fc-daygrid-day-number { font-weight: 700 !important; color: #44403c !important; text-decoration: none !important; }
    .fc .fc-highlight { background: rgba(245, 158, 11, 0.3) !important; } /* Changes highlited drag color to amber overlay */
</style>
@endsection