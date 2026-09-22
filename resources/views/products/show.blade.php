@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-dark">Detail Produk</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless fs-6">
                    <tr>
                        <th width="160" class="text-muted">Kode Produk</th>
                        <td>: <span class="badge bg-secondary fs-6">{{ $product->kode_produk }}</span></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Nama Produk</th>
                        <td class="fw-semibold">: {{ $product->nama_produk }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Kategori</th>
                        <td>: {{ $product->kategori }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Harga</th>
                        <td class="text-success fw-bold">: Rp{{ number_format($product->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Stok</th>
                        <td>: {{ $product->stok }} unit</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Deskripsi</th>
                        <td>: {{ $product->deskripsi ?? '-' }}</td>
                    </tr>
                </table>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning text-white">Edit Produk</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection