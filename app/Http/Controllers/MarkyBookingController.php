<?php

namespace App\Http\Controllers;

use App\Models\MarkyBooking;
use App\Models\MarkyRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MarkyBookingController extends Controller
{
    public function index()
    {
        // Security Gate: Standard users are locked out from viewing the master list view
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Only administrative accounts are allowed here.');
        }

        $markyBookings = MarkyBooking::with('markyRoom')->get();
        return view('marky_views.bookings_index', compact('markyBookings'));
    }

    // Step 1: Select Room and Input Details
    public function createWizardStepOne(Request $request)
    {
        $markyRooms = MarkyRoom::all();
        $markySessionData = $request->session()->get('booking_data', []);
        
        return view('marky_views.bookings_step_one', compact('markyRooms', 'markySessionData'));
    }

    public function postWizardStepOne(Request $request)
    {
        $validated = $request->validate([
            'marky_room_id' => 'required|exists:marky_rooms,marky_room_id',
            'marky_customer_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'marky_customer_email' => 'required|email|max:255',
            'marky_check_in' => 'required|date|after_or_equal:today',
            'marky_check_out' => 'required|date|after:marky_check_in',
        ], [
            'marky_customer_name.regex' => 'The customer name must contain only letters and spaces.',
            'marky_check_out.after' => 'The check-out date must be at least one day after the check-in date.',
        ]);

        $overlapConflict = MarkyBooking::where('marky_room_id', $request->marky_room_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('marky_check_in', [$request->marky_check_in, $request->marky_check_out])
                      ->orWhereBetween('marky_check_out', [$request->marky_check_in, $request->marky_check_out])
                      ->orWhere(function ($subQuery) use ($request) {
                          $subQuery->where('marky_check_in', '<=', $request->marky_check_in)
                                   ->where('marky_check_out', '>=', $request->marky_check_out);
                      });
            })->exists();

        if ($overlapConflict) {
            return back()->withInput()->withErrors(['marky_check_in' => 'This room is already reserved for part of your requested dates.']);
        }

        $room = MarkyRoom::findOrFail($request->marky_room_id);
        $checkIn = Carbon::parse($request->marky_check_in);
        $checkOut = Carbon::parse($request->marky_check_out);
        
        $totalDays = $checkIn->diffInDays($checkOut);
        if ($totalDays <= 0) { $totalDays = 1; }

        $totalCost = $totalDays * $room->marky_room_price;

        $bookingSessionData = array_merge($validated, [
            'total_days' => $totalDays,
            'marky_total_price' => $totalCost,
            'room_name' => $room->marky_room_name,
            'room_price' => $room->marky_room_price
        ]);

        session(['booking_data' => $bookingSessionData]);

        return redirect()->route('marky_bookings.wizard.step_two');
    }

    // Step 2: Confirmation File Upload
    public function createWizardStepTwo(Request $request)
    {
        if (!session()->has('booking_data')) {
            return redirect()->route('marky_bookings.wizard.step_one');
        }
        
        return view('marky_views.bookings_step_two');
    }

    public function postWizardStepTwo(Request $request)
    {
        $request->validate([
            'marky_confirmation_file' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $bookingSessionData = session('booking_data');

        if ($request->hasFile('marky_confirmation_file')) {
            $filePath = $request->file('marky_confirmation_file')->store('marky_confirmations', 'public');
            $bookingSessionData['marky_confirmation_file'] = $filePath;
            session(['booking_data' => $bookingSessionData]);
        }

        return redirect()->route('marky_bookings.wizard.summary');
    }

    // Step 3: Summary Page
    public function wizardSummary(Request $request)
    {
        if (!session()->has('booking_data')) {
            return redirect()->route('marky_bookings.wizard.step_one');
        }

        return view('marky_views.bookings_summary');
    }

    public function finalizeWizard(Request $request)
    {
        if (!session()->has('booking_data')) {
            return redirect()->route('marky_bookings.wizard.step_one');
        }

        $data = session('booking_data');

        $overlapConflict = MarkyBooking::where('marky_room_id', $data['marky_room_id'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('marky_check_in', [$data['marky_check_in'], $data['marky_check_out']])
                      ->orWhereBetween('marky_check_out', [$data['marky_check_in'], $data['marky_check_out']]);
            })->exists();

        if ($overlapConflict) {
            session()->forget('booking_data');
            return redirect()->route('marky_bookings.wizard.step_one')->withErrors(['marky_check_in' => 'The selected dates were taken by another user during finalization.']);
        }

        MarkyBooking::create([
            'marky_room_id' => $data['marky_room_id'],
            'marky_customer_name' => $data['marky_customer_name'],
            'marky_customer_email' => $data['marky_customer_email'],
            'marky_check_in' => $data['marky_check_in'],
            'marky_check_out' => $data['marky_check_out'],
            'marky_total_price' => $data['marky_total_price'],
            'marky_confirmation_file' => $data['marky_confirmation_file'] ?? null,
        ]);

        session()->forget('booking_data');

        // FIXED DIRECTION: Standard users land back onto dashboard metrics, not the general admin records table array
        return redirect()->route('dashboard')->with('success', 'Your booking reservation has been successfully completed!');
    }

    public function edit(MarkyBooking $markyBooking)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $markyRooms = MarkyRoom::all();
        return view('marky_views.bookings_edit', compact('markyBooking', 'markyRooms'));
    }

    public function update(Request $request, MarkyBooking $markyBooking)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'marky_room_id' => 'required|exists:marky_rooms,marky_room_id',
            'marky_customer_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'marky_customer_email' => 'required|email|max:255',
            'marky_check_in' => 'required|date',
            'marky_check_out' => 'required|date|after:marky_check_in',
        ]);

        $room = MarkyRoom::findOrFail($request->marky_room_id);
        $checkIn = Carbon::parse($request->marky_check_in);
        $checkOut = Carbon::parse($request->marky_check_out);
        $totalDays = $checkIn->diffInDays($checkOut) ?: 1;

        $validated['marky_total_price'] = $totalDays * $room->marky_room_price;

        $markyBooking->update($validated);

        return redirect()->route('marky_bookings.index')->with('success', 'Booking tracking matrices updated successfully!');
    }

    public function destroy(MarkyBooking $markyBooking)
    {
        if ($markyBooking->marky_confirmation_file) {
            Storage::disk('public')->delete($markyBooking->marky_confirmation_file);
        }
        $markyBooking->delete();
        return redirect()->route('marky_bookings.index')->with('success', 'Booking cancelled successfully.');
    }

    public function getBookedDatesJson()
    {
        $bookings = MarkyBooking::all(['marky_customer_name', 'marky_check_in', 'marky_check_out']);

        $events = [];
        foreach ($bookings as $booking) {
            $events[] = [
                'title' => 'Reserved: ' . $booking->marky_customer_name,
                'start' => $booking->marky_check_in,
                'end'   => Carbon::parse($booking->marky_check_out)->addDay()->toDateString(),
                'color' => '#f59e0b',
                'textColor' => '#0a0a0a',
                'allDay' => true
            ];
        }

        return response()->json($events);
    }
}