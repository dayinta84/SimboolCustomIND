@extends('layout.adminlte')
@section('title', 'Kelola Marketplace')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-dark shadow-lg rounded-3 border-0">
                <div class="card-header bg-gradient-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0"><i class="fas fa-store me-2"></i> Kelola Marketplace</h4>
                </div>
                <div class="card-body">

                    {{-- ✅ Pesan sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- ✅ Form Tambah Marketplace --}}
                    <div class="card card-gray card-outline mb-4 shadow-sm">
                        <div class="card-header bg-gradient-gray text-dark">
                            <h5 class="card-title mb-0"><i class="fas fa-plus-circle me-2"></i> Tambah Marketplace Baru</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.marketplace.store', ['role' => Auth::user()->role]) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="platform" class="form-label"><i class="fas fa-globe me-1"></i> Platform</label>
                                            <input type="text" name="platform" id="platform" class="form-control @error('platform') is-invalid @enderror" placeholder="Contoh: Shopee, TikTok, Instagram" required>
                                            @error('platform')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username" class="form-label"><i class="fas fa-user-tag me-1"></i> Username</label>
                                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="@nama_akun">
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="followers" class="form-label"><i class="fas fa-users me-1"></i> Followers</label>
                                            <input type="text" name="followers" id="followers" class="form-control @error('followers') is-invalid @enderror" placeholder="Contoh: 10k, 2500">
                                            @error('followers')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link" class="form-label"><i class="fas fa-link me-1"></i> Link</label>
                                            <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror" placeholder="https://...">
                                            @error('link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="icon" class="form-label"><i class="fas fa-icons me-1"></i> Icon (Logo Platform)</label>
                                            <input type="file" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" accept="image/*">
                                            @error('icon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-dark btn-lg w-100">
                                        <i class="fas fa-plus me-2"></i> Tambah Marketplace
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- ✅ Daftar Marketplace --}}
                    <div class="card card-gray card-outline shadow-sm rounded-3 border-0">
                        <div class="card-header bg-gradient-gray text-dark">
                            <h5 class="card-title mb-0"><i class="fas fa-list me-2"></i> Daftar Marketplace Tersimpan</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle text-nowrap">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width: 50px;">#</th>
                                            <th>Platform</th>
                                            <th>Username</th>
                                            <th>Followers</th>
                                            <th>Link</th>
                                            <th>Icon</th>
                                            <th style="width: 150px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($marketplaces as $index => $market)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><strong>{{ $market->platform }}</strong></td>
                                                <td>{{ $market->username }}</td>
                                                <td><span class="badge bg-dark">{{ $market->followers }}</span></td>
                                                <td>
                                                    @if($market->link)
                                                        <a href="{{ $market->link }}" target="_blank" class="btn btn-xs btn-outline-dark">
                                                            <i class="fas fa-external-link-alt"></i> Kunjungi
                                                        </a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($market->icon)
                                                        <img src="{{ asset('storage/' . $market->icon) }}" alt="{{ $market->platform }}" class="img-thumbnail rounded-circle" width="40" height="40">
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('admin.marketplace.edit.single', ['role' => Auth::user()->role, 'id' => $market->id]) }}"
                                                           class="btn btn-sm btn-warning flex-fill">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.marketplace.destroy', ['role' => Auth::user()->role, 'id' => $market->id]) }}"
                                                              method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger flex-fill"
                                                                    onclick="return confirm('Yakin ingin menghapus {{ $market->platform }}?')">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5 text-muted">
                                                    <i class="fas fa-store-slash fa-2x mb-3"></i>
                                                    <p class="mb-0">Belum ada marketplace yang ditambahkan.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection