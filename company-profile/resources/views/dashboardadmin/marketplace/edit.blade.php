@extends('layout.adminlte')
@section('title', 'Kelola Marketplace')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Kelola Marketplace</h2>

    {{-- ✅ Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- ✅ Form Tambah Marketplace --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header fw-bold">Tambah Marketplace</div>
        <div class="card-body">
            <form action="{{ route('admin.marketplace.store', ['role' => Auth::user()->role]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Platform</label>
                        <input type="text" name="platform" class="form-control" placeholder="Contoh: Shopee, TikTok, Instagram" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="@nama_akun">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Followers</label>
                        <input type="text" name="followers" class="form-control" placeholder="Contoh: 10k, 2500">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Link</label>
                        <input type="url" name="link" class="form-control" placeholder="https://...">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Deskripsi singkat akun..."></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Icon (Logo Platform)</label>
                        <input type="file" name="icon" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah Marketplace</button>
            </form>
        </div>
    </div>

    {{-- ✅ Daftar Marketplace --}}
    <div class="card shadow-sm">
        <div class="card-header fw-bold">Daftar Marketplace</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Platform</th>
                        <th>Username</th>
                        <th>Followers</th>
                        <th>Deskripsi</th>
                        <th>Link</th>
                        <th>Icon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($marketplaces as $index => $market)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $market->platform }}</td>
                            <td>{{ $market->username }}</td>
                            <td>{{ $market->followers }}</td>
                            <td>{{ $market->description }}</td>
                            <td>
                                @if($market->link)
                                    <a href="{{ $market->link }}" target="_blank">Kunjungi</a>
                                @endif
                            </td>
                            <td>
                                @if($market->icon)
                                    <img src="{{ asset('storage/' . $market->icon) }}" alt="icon" width="40">
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.marketplace.destroy', ['role' => Auth::user()->role, 'id' => $market->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada marketplace</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
