@extends('layout')

@section('content')
<div class="container" style="background-color: #f5f5f5; padding: 20px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-header" style="background-color: #86c995; color: #fff; border-radius: 5px;">
                    {{ __('Table Booking') }}
                </div>

                <div class="card-body">
                    <a href="{{ route('bookings.create') }}" class="btn btn-sm btn-secondary mb-3">
                        Tambah Booking Ruangan
                    </a>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr style="background-color: #86c995; color: #fff;">
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Booking</th>
                                    <th scope="col">Start Booking</th>
                                    <th scope="col">End Booking</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @foreach($bookings as $row)
                                <?php $no++ ?>
                                <tr>
                                    <th scope="row">{{ $no }}</th>
                                    <td>{{ $row->user->name ?? 'User Tidak Ditemukan' }}</td>
                                    <td>{{ $row->ruangan->nama_ruangan ?? 'Ruangan Tidak Ditemukan' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->start_book)->format('[l, d F Y] [H:i]') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->end_book)->format('[l, d F Y] [H:i]') }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('bookings.edit', $row->id) }}" class="btn btn-sm btn-warning me-2">
                                            Edit
                                        </a>
                                        <form action="{{ route('bookings.destroy', $row->id) }}" method="POST"
                                            onsubmit="return confirm('Do you really want to delete {{ $row->user_id }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <span class="text-muted">Delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
