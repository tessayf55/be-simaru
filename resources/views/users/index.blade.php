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
                    {{ __('Table Users') }}
                </div>

                <div class="card-body">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-secondary mb-3">
                        Tambah User
                    </a>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr style="background-color: #86c995; color: #fff;">
                                    <th scope="col">#</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @foreach($users as $row)
                                <?php $no++ ?>
                                <tr>
                                    <th scope="row">{{ $no }}</th>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->role}}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('users.edit', $row->id) }}" class="btn btn-sm btn-warning me-2">
                                            Edit
                                        </a>
                                        <form action="{{ route('users.destroy',$row->id) }}" method="POST"
                                            onsubmit="return confirm('Do you really want to delete {{ $row->name }}?');">
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
