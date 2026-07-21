<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Summary Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans min-h-screen flex items-center justify-center p-4">

<div class="max-w-2xl w-full bg-white rounded-2xl border border-slate-200 shadow-xl p-8 transition-all hover:shadow-2xl">
    <div class="mb-8 border-b border-slate-100 pb-5">
        <span class="text-xs font-bold uppercase tracking-widest text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full">Step 3 of 3</span>
        <h2 class="text-2xl font-black text-slate-900 mt-3">Manifest Verification Statement</h2>
        <p class="text-sm text-slate-500 mt-1">Please confirm your parameter details before committing this reservation.</p>
    </div>

    <div class="bg-slate-50 rounded-xl p-6 space-y-4 border border-slate-100 mb-8">
        <div class="flex justify-between items-center text-sm">
            <span class="text-slate-500 font-medium">Selected Corporate Asset:</span>
            <span class="font-bold text-slate-900 bg-white px-3 py-1 rounded-md border border-slate-200 shadow-sm">{{ session('booking_data.room_name') }}</span>
        </div>
        
        <div class="flex justify-between items-center text-sm">
            <span class="text-slate-500 font-medium">Daily Base Rate:</span>
            <span class="font-mono font-semibold text-slate-700">PHP {{ number_format(session('booking_data.room_price'), 2) }}</span>
        </div>
        
        <div class="flex justify-between items-center text-sm">
            <span class="text-slate-500 font-medium">Total Duration Manifest:</span>
            <span class="font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-md">{{ session('booking_data.total_days') }} Days</span>
        </div>
        
        <div class="flex justify-between items-center text-sm">
            <span class="text-slate-500 font-medium">Stay Period:</span>
            <span class="font-semibold text-slate-800 bg-white px-3 py-1 rounded-md border border-slate-200 text-xs font-mono">
                {{ session('booking_data.marky_check_in') }} <span class="text-slate-400 mx-1">→</span> {{ session('booking_data.marky_check_out') }}
            </span>
        </div>
        
        <div class="pt-5 border-t border-slate-200 flex justify-between items-center">
            <span class="text-base font-extrabold text-slate-900">Total System Billing Cost:</span>
            <div class="text-right">
                <span class="text-2xl font-black text-emerald-600 tracking-tight">PHP {{ number_format(session('booking_data.marky_total_price'), 2) }}</span>
                <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">All inclusive tax base</p>
            </div>
        </div>
    </div>

    <form action="{{ route('marky_bookings.wizard.finalize') }}" method="POST">
        @csrf
        <div class="flex flex-col sm:flex-row justify-between gap-4">
            <a href="{{ route('marky_bookings.wizard.step_one') }}" class="w-full sm:w-1/3 text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm py-3.5 px-4 rounded-xl transition duration-200 focus:outline-none focus:ring-2 focus:ring-slate-300">
                Modify Dates
            </a>
            <button type="submit" class="w-full sm:w-2/3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold text-sm py-3.5 px-4 rounded-xl shadow-lg shadow-blue-600/20 transition duration-200 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Commit & Finalize Reservation
            </button>
        </div>
    </form>
</div>

</body>
</html>