@extends('layout.adminlte')
@section('title', 'Edit Marketplace')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Marketplace</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.marketplace.update', ['role' => Auth::user()->role, 'id' => $marketplace->id]) }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Platform</label>
                    <input type="text" name="platform" class="form-control" value="{{ old('platform', $marketplace->platform) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username', $marketplace->username) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Followers</label>
                    <input type="text" name="followers" class="form-control" value="{{ old('followers', $marketplace->followers) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Link</label>
                    <input type="url" name="link" class="form-control" value="{{ old('link', $marketplace->link) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Icon (Logo)</label><br>
                    @if($marketplace->icon)
                        <img src="{{ asset('storage/' . $marketplace->icon) }}" width="60" class="mb-2"><br>
                    @endif
                    <input type="file" name="icon" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('admin.marketplace.edit', ['role' => Auth::user()->role]) }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
