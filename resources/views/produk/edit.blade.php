@extends('layout')

@section('content')
    <h1>Edit Produk</h1>
    <form action="{{ route('produk.update', $produk->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" id="nama_produk" value="{{ $produk->nama_produk }}">
        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi">{{ $produk->deskripsi }}</textarea>
        <label for="harga">Harga:</label>
        <input type="number" name="harga" id="harga" step="0.01" value="{{ $produk->harga }}">
        <label for="jumlah_stok">Jumlah Stok:</label>
        <input type="number" name="jumlah_stok" id="jumlah_stok" value="{{ $produk->jumlah_stok }}">
        <button type="submit">Update</button>
    </form>
@endsection
