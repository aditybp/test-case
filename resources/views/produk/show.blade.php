@extends('layout')

@section('content')
    <h1>Detail Produk</h1>
    <p><strong>Nama Produk:</strong> {{ $produk->nama_produk }}</p>
    <p><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
    <p><strong>Harga:</strong> {{ $produk->harga }}</p>
    <p><strong>Jumlah Stok:</strong> {{ $produk->jumlah_stok }}</p>
    <a href="{{ route('produk.index') }}">Kembali</a>
@endsection
