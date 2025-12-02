@extends('layout.adminlte')
@section('title', 'Kelola User')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><i class="fas fa-users"></i> Kelola User</h3>
                    <a href="{{ route('superadmin.users.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah User
                    </a>
                </div>
                <!-- /.card-header -->

                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            <span class="badge badge-{{ $user->role === 'superadmin' ? 'danger' : 'info' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('superadmin.users.edit', $user->id) }}" class="btn btn-xs btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('superadmin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                                            <p>Belum ada user.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
@endsection