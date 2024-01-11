<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Ruangan;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Validator;
use Hash;

class BookingController extends Controller
{
    public function index(){
        $bookings = Booking::All();
        return view('bookings/index', compact('bookings'));
    } 

    //public function index() {
    //    return response()->json(Booking::All());
    //}

    public function create(){
        $roles = Ruangan::All();
        return view('bookings/create', compact('roles'));
    }

public function store(Request $request)
{
    $request->validate([
        'ruangan_id' => 'required|int',
        'start_book' => 'required|date',
        'end_book' => 'required|date|after:start_book',
    ]);

    // Mendapatkan ID user yang sedang login
    $user_id = Auth::id();

    // Menyusun data untuk disimpan
    $data = [
        'user_id' => $user_id,
        'ruangan_id' => $request->ruangan_id,
        'start_book' => $request->start_book,
        'end_book' => $request->end_book,
    ];

    // Menyimpan data ke database
    $booking = Booking::create($data);

    return redirect()->route('bookings.index')->withSuccess('Great! You have Successfully Booking');
}

    public function edit(Booking $booking)
    {   
        $roles = Ruangan::all();
        return view('bookings.edit', compact('booking', 'roles'));
    }
    

public function update(Request $request, Booking $booking)
{
    $request->validate([
        'user_id' => 'required',
        'ruangan_id' => 'required',
        'start_book' => 'required',
        'end_book' => 'required|after:start_book',
    ]);

    $booking->user_id = $request->user_id;
    $booking->ruangan_id = $request->ruangan_id;
    $booking->start_book = $request->start_book;
    $booking->end_book = $request->end_book;

    $booking->save();

    return redirect()->route('bookings.index')->withSuccess('Great! You have Successfully Updated Booking');
}


    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success','booking has been deleted successfully');
    }
}
