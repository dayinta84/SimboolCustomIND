<!-- @extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-3">Kelola Produk</h2>
    <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->deskripsi }}</td>
                <td>Rp{{ number_format($p->harga, 0, ',', '.') }}</td>
                <td>
                    @if($p->gambar)
                        <img src="{{ asset('storage/'.$p->gambar) }}" width="60">
                    @endif
                </td>
                <td>
                    <a href="{{ route('product.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('product.destroy', $p->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection -->
