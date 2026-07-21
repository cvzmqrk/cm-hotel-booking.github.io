@extends('layouts.marky_app')

@section('marky_content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8 flex items-center justify-between border-b border-stone-200 pb-5">
        <div>
            <h1 class="text-2xl font-black text-neutral-900 tracking-tight">Modify Asset Room</h1>
            <p class="mt-1 text-sm text-stone-500">Update parameters, description matrices, or base rate adjustments for this space.</p>
        </div>
        <a href="/marky_rooms" class="text-xs font-bold uppercase tracking-wider text-stone-600 hover:text-neutral-950 bg-stone-100 hover:bg-stone-200 px-4 py-2.5 rounded-xl transition border border-stone-200">
            Back to List
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-xl p-8">
        <form action="{{ route('marky_rooms.update', $markyRoom->marky_room_id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-neutral-700 mb-2">Asset/Room Name</label>
                    <input type="text" name="marky_room_name" value="{{ old('marky_room_name', $markyRoom->marky_room_name) }}" class="w-full rounded-xl border border-stone-200 bg-stone-50/50 px-4 py-3.5 text-sm text-neutral-900 focus:border-amber-500 focus:bg-white focus:ring-1 focus:ring-amber-500 focus:outline-none transition font-semibold" required>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-neutral-700 mb-2">Description Manifest</label>
                    <textarea name="marky_room_description" rows="4" class="w-full rounded-xl border border-stone-200 bg-stone-50/50 px-4 py-3.5 text-sm text-neutral-900 focus:border-amber-500 focus:bg-white focus:ring-1 focus:ring-amber-500 focus:outline-none transition font-medium" required>{{ old('marky_room_description', $markyRoom->marky_room_description) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-neutral-700 mb-2">Daily Cost Rate (₱)</label>
                    <div class="relative mt-1 rounded-xl shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                            <span class="text-neutral-900 sm:text-sm font-black">₱</span>
                        </div>
                        <input type="number" name="marky_room_price" step="0.01" min="0" value="{{ old('marky_room_price', $markyRoom->marky_room_price) }}" class="w-full rounded-xl border border-stone-200 bg-stone-50/50 pl-9 pr-4 py-3.5 text-sm font-bold text-neutral-900 focus:border-amber-500 focus:bg-white focus:ring-1 focus:ring-amber-500 focus:outline-none transition" required>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-stone-100 flex items-center justify-end space-x-3">
                <a href="/marky_rooms" class="rounded-xl bg-stone-100 hover:bg-stone-200 px-5 py-3.5 text-sm font-bold text-stone-700 transition">
                    Cancel Changes
                </a>
                <button type="submit" class="rounded-xl bg-neutral-950 hover:bg-neutral-800 text-amber-500 font-bold text-sm px-6 py-3.5 shadow-lg transition transform active:scale-95">
                    Commit Updates
                </button>
            </div>
        </form>
    </div>
</div>
@endsection