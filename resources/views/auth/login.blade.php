@extends('layouts.marky_app')

@section('marky_content')
<div class="w-full max-w-5xl bg-white rounded-[32px] overflow-hidden shadow-2xl border border-slate-200/60 flex flex-col md:flex-row my-6 min-h-[550px]">
    
    <!-- LEFT PANEL BRAND DECORATIVE GRID DISPLAY -->
    <div class="w-full md:w-1/2 bg-[#0a0a0a] p-12 flex flex-col justify-between relative overflow-hidden">
        <!-- Abstract Background Aura Blobs -->
        <div class="absolute -top-12 -left-12 w-64 h-64 bg-amber-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-12 -right-12 w-64 h-64 bg-amber-600/10 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <span class="bg-amber-500/10 text-amber-500 font-black text-[10px] uppercase tracking-widest px-3 py-1 rounded-full border border-amber-500/20">
                Premium Gateway
            </span>
        </div>
        
        <div class="relative z-10 my-auto pt-12 pb-6">
            <h2 class="text-white text-3xl font-black tracking-tight leading-tight uppercase">
                Unlock Luxury <br><span class="text-amber-500">Accommodations</span>
            </h2>
            <p class="text-stone-400 text-xs font-medium mt-3 max-w-sm leading-relaxed">
                Log in using your verified credential vectors to access active bookings or orchestrate real-time date reservations.
            </p>
        </div>

        <div class="relative z-10 border-t border-stone-900 pt-4">
            <p class="text-[10px] text-stone-500 uppercase tracking-widest font-black">C&M Hotel Experience Engine v2.0</p>
        </div>
    </div>

    <!-- RIGHT PANEL TRANSACTION SUBMISSION FORM BLOCK -->
    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center bg-white">
        <div class="mb-6">
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Account Sign In</h1>
            <p class="text-slate-500 text-xs mt-1">Please enter your parameters below to manage records.</p>
        </div>

        <!-- ERROR MESSAGE TEMPLATE LIST -->
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded-xl">
                <ul class="list-none text-[11px] text-red-700 font-bold uppercase tracking-wide space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>⚠ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Electronic Email Address -->
            <div>
                <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1.5">
                    Email Address
                </label>
                <input type="email" id="email" name="email" required autocomplete="email" autofocus
                    placeholder="name@domain.com"
                    value="{{ old('email') }}"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-xs font-bold px-4 py-3.5 rounded-xl focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-500/10 transition duration-150">
            </div>

            <!-- Secret Password Element -->
            <div>
                <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1.5">
                    Secret Password
                </label>
                <input type="password" id="password" name="password" required autocomplete="current-password"
                    placeholder="••••••••••••"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-xs font-bold px-4 py-3.5 rounded-xl focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-500/10 transition duration-150">
            </div>

            <!-- Remember Login Token Wrapper -->
            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center space-x-2 cursor-pointer select-none">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500/30">
                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Keep me signed in</span>
                </label>
            </div>

            <!-- Action Button Submission Grid -->
            <button type="submit"
                class="w-full bg-neutral-950 hover:bg-neutral-900 text-amber-500 text-xs font-black uppercase tracking-widest py-4 rounded-xl transition duration-200 shadow-lg transform active:scale-[0.99] pt-4">
                Access System Account
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-500 font-medium">
                Don't possess a dynamic customer profile yet? 
                <a href="{{ route('register') }}" class="text-amber-600 hover:text-amber-700 font-black uppercase tracking-wider ml-1 hover:underline">Register Here</a>
            </p>
        </div>
    </div>

</div>
@endsection