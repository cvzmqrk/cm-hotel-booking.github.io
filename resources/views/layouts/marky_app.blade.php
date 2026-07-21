<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C&M Hotel - Premium Reservation Engine</title>
    <!-- Tailwind CSS Engine -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen font-sans antialiased text-slate-800">

    <!-- GLOBAL DYNAMIC HEADER NAVIGATION PANEL -->
    <nav class="bg-[#0a0a0a] border-b border-stone-900 sticky top-0 z-50 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            
            <!-- BRAND LOGO HEADER IDENTITY -->
            <a href="/" class="flex items-center space-x-2 group">
                <span class="text-white font-black text-xl tracking-tighter transition group-hover:text-amber-500">C&M</span>
                <span class="bg-amber-500/10 text-amber-500 font-black text-[10px] uppercase tracking-widest px-2 py-0.5 rounded-md border border-amber-500/20">Hotel</span>
            </a>

            <!-- NAVIGATION MIDDLE CONTAINER -->
            <div class="hidden md:flex items-center space-x-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-stone-400 hover:text-white font-black text-xs uppercase tracking-widest transition">Dashboard</a>
                    
                    <!-- ADMIN-EXCLUSIVE NAVIGATION LINKS -->
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('marky_bookings.index') }}" class="text-amber-500 hover:text-amber-400 font-black text-xs uppercase tracking-widest transition">Active Bookings</a>
                        <a href="{{ route('marky_rooms.index') }}" class="text-amber-500 hover:text-amber-400 font-black text-xs uppercase tracking-widest transition">Room Management</a>
                    @else
                        <!-- USER-ONLY NAVIGATION LINKS -->
                        <a href="{{ route('marky_bookings.wizard.step_one') }}" class="text-stone-400 hover:text-white font-black text-xs uppercase tracking-widest transition">Booking Wizard</a>
                    @endif
                @endauth
            </div>

            <!-- RIGHT CONTROL CONTAINER PANEL -->
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-stone-400 hover:text-white font-bold text-xs uppercase tracking-wider transition">Log In</a>
                    <a href="{{ route('register') }}" class="text-stone-400 hover:text-white font-bold text-xs uppercase tracking-wider transition">Register</a>
                    
                    <!-- Guest Mode Action Trigger -->
                    <button onclick="triggerAuthWarning()" class="bg-amber-500 hover:bg-amber-600 text-neutral-950 font-black text-xs uppercase tracking-widest px-4 py-2.5 rounded-xl transition duration-150 shadow-md">
                        New Reservation
                    </button>
                @else
                    <span class="bg-neutral-800 text-amber-500 font-bold text-xs px-3 py-1.5 rounded-lg border border-neutral-700">
                        Hi, {{ Auth::user()->name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-stone-400 hover:text-white font-bold text-xs uppercase tracking-wider transition">Log Out</button>
                    </form>
                    
                    @if(Auth::user()->role !== 'admin')
                        <a href="{{ route('marky_bookings.wizard.step_one') }}" class="bg-amber-500 hover:bg-amber-600 text-neutral-950 font-black text-xs uppercase tracking-widest px-4 py-2.5 rounded-xl transition duration-150 shadow-md">
                            New Reservation
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- MAIN CORE WRAPPER CONTENT BOUNDARY -->
    <main class="flex-grow flex items-center justify-center p-4">
        @yield('marky_content')
    </main>

    <!-- SYSTEM BASE FOUNTAIN FOOTER LAYER -->
    <footer class="bg-[#0a0a0a] text-center py-5 border-t border-stone-900">
        <p class="text-stone-500 text-[11px] font-medium tracking-wide">
            &copy; 2026 C&M Advanced Programming Reservation Engine. All Rights Reserved.
        </p>
    </footer>

    <!-- CLIENT POP INTERACTION ENGINE SCRIPT -->
    <script>
        function triggerAuthWarning() {
            alert("🔒 Access Restricted\n\nPlease log in or register a customer account first to configure a reservation pipeline wizard.");
        }
    </script>

</body>
</html>