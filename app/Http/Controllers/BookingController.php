<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;
use Validator;

class BookingController extends Controller
{
    public function index() {
        $bookings = Booking::with(['user', 'booking'])->get();
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

    public function edit(Booking $booking) {
        return response()->json($booking);
    }

    public function update(Request $request, Booking $booking)  {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'numeric'],
            'ruangan_id' => ['required', 'numeric'],
            'start_book' => 'required',
            'end_book' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $booking = Booking::where('id', $booking->id)->update([
            'user_id' => $request->user_id,
            'ruangan_id' => $request->ruangan_id,
            'start_book' => $request->start_book,
            'end_book' => $request->end_book,
        ]);
        return response()->json([
            'message' => 'Booking successfully updated'
        ], 201);
    }

    public function delete($id)  {
        $booking = Booking::find($id);
        $booking->delete();
        return response()->json([
            'message' => 'Booking successfully deleted',
        ], 201);
    }
}
