@extends('layout')

@section('content')
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Add Booking</div>
                    <div class="card-body">

                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf

                            <div class="mb-3 row">
                                <label for="ruangan_id" class="col-md-4 col-form-label text-md-end">Ruangan</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="ruangan_id" name="ruangan_id" aria-label="ruangan_id">
                                        <option value="">Pilih Ruangan yang akan di Booking</option>
                                        @foreach($roles as $ruangan)
                                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
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
                                    <input type="datetime-local" id="start_book" class="form-control" name="start_book" required autofocus>
                                    @error('start_book')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="end_book" class="col-md-4 col-form-label text-md-end">End Book</label>
                                <div class="col-md-6">
                                    <input type="datetime-local" id="end_book" class="form-control" name="end_book" required autofocus>
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

<!-- Add the following script to fill the "User ID" field with the current user's ID -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var user_id_input = document.getElementById("user_id");
        if (user_id_input) {
            // Get the user ID from the logged-in user (you may need to adjust this based on your authentication system)
            var user_id = "{{ auth()->user()->id ?? '' }}";

            // Set the value of the "User ID" input field
            user_id_input.value = user_id;

            // Hide the "User ID" input field
            user_id_input.style.display = "none";
        }
    });
</script>
@endsection
