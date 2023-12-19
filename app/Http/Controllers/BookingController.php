<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;
use Validator;

class BookingController extends Controller
{
    public function index() {
        $bookings = Booking::with(['user', 'ruangan'])->get();
        return response()->json($bookings);
    }

    public function create(Request $request)  {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'numeric'],
            'ruangan_id' => ['required', 'numeric'],
            'start_book' => 'required',
            'end_book' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $booking = Booking::create([
            'user_id' => $request->user_id,
            'ruangan_id' => $request->ruangan_id,
            'start_book' => $request->start_book,
            'end_book' => $request->end_book,
        ]);
        return response()->json([
            'message' => 'Booking successfully submitted',
            'booking' => $booking
        ], 201);
    }
}
