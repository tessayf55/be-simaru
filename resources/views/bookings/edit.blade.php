@extends('layout')

@section('content')
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Edit Booking</div>
                    <div class="card-body">

                        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3 row">
                                <label for="user_id" class="col-md-4 col-form-label text-md-end">User ID</label>
                                <div class="col-md-6">
                                    <input type="text" id="user_id" class="form-control" name="user_id" required autofocus value="{{ $booking->user_id }}" readonly>
                                    <!-- Menonaktifkan kolom agar tidak dapat diubah oleh pengguna -->
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="ruangan_id" class="col-md-4 col-form-label text-md-end">Ruangan</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="ruangan_id" name="ruangan_id" aria-label="ruangan_id">
                                        <option value="">Pilih Ruangan yang akan di Booking</option>
                                        @foreach($roles as $ruangan)
                                        <option value="{{ $ruangan->id }}" {{ $ruangan->id == $booking->ruangan_id ? 'selected' : '' }}>
                                            {{ $ruangan->nama_ruangan }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('ruangan_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="start_book" class="col-md-4 col-form-label text-md-end">Start Book</label>
                                <div class="col-md-6">
                                    <input type="datetime-local" id="start_book" class="form-control" name="start_book" required autofocus value="{{ date('Y-m-d\TH:i', strtotime($booking->start_book)) }}">
                                    @error('start_book')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="end_book" class="col-md-4 col-form-label text-md-end">End Book</label>
                                <div class="col-md-6">
                                    <input type="datetime-local" id="end_book" class="form-control" name="end_book" required autofocus value="{{ date('Y-m-d\TH:i', strtotime($booking->end_book)) }}">
                                    @error('end_book')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4 mt-3 p-2 d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
