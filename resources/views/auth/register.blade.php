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
                Join Membership
            </span>
        </div>
        
        <div class="relative z-10 my-auto pt-12 pb-6">
            <h2 class="text-white text-3xl font-black tracking-tight leading-tight uppercase">
                Begin Your <br><span class="text-amber-500">Journey With Us</span>
            </h2>
            <p class="text-stone-400 text-xs font-medium mt-3 max-w-sm leading-relaxed">
                Construct an exclusive profile instance across our global secure node matrix to access individual booking allocations effortlessly.
            </p>
        </div>

        <div class="relative z-10 border-t border-stone-900 pt-4">
            <p class="text-[10px] text-stone-500 uppercase tracking-widest font-black">C&M Hotel Experience Engine v2.0</p>
        </div>
    </div>

    <!-- RIGHT PANEL TRANSACTION SUBMISSION FORM BLOCK -->
    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center bg-white">
        <div class="mb-6">
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Create Profile</h1>
            <p class="text-slate-500 text-xs mt-1">Please define your authentication metrics to finalize authorization.</p>
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

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Full Legal Identification Identity Name -->
            <div>
                <label for="name" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1.5">
                    Full Account Name
                </label>
                <input type="text" id="name" name="name" required autocomplete="name" autofocus
                    placeholder="e.g., Jane Doe"
                    value="{{ old('name') }}"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-xs font-bold px-4 py-3.5 rounded-xl focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-500/10 transition duration-150">
            </div>

            <!-- Electronic Email Routing Address -->
            <div>
                <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1.5">
                    Email Address
                </label>
                <input type="email" id="email" name="email" required autocomplete="email"
                    placeholder="name@domain.com"
                    value="{{ old('email') }}"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-xs font-bold px-4 py-3.5 rounded-xl focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-500/10 transition duration-150">
            </div>

            <!-- Password Parameters Split Vector -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1.5">
                        Password
                    </label>
                    <input type="password" id="password" name="password" required autocomplete="new-password"
                        placeholder="••••••••••••"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-xs font-bold px-4 py-3.5 rounded-xl focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-500/10 transition duration-150">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1.5">
                        Confirm Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                        placeholder="••••••••••••"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-xs font-bold px-4 py-3.5 rounded-xl focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-500/10 transition duration-150">
                </div>
            </div>

            <!-- Action Button Submission Grid -->
            <button type="submit"
                class="w-full bg-neutral-950 hover:bg-neutral-900 text-amber-500 text-xs font-black uppercase tracking-widest py-4 rounded-xl transition duration-200 shadow-lg transform active:scale-[0.99] pt-4">
                Register Secure Account
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-500 font-medium">
                Already registered a premium membership?
                <a href="{{ route('login') }}" class="text-amber-600 hover:text-amber-700 font-black uppercase tracking-wider ml-1 hover:underline">Log In Instead</a>
            </p>
        </div>
    </div>

</div>
@endsection