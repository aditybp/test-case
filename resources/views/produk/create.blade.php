@extends('layout')

@section('content')
    <h1>Tambah Produk</h1>
    <form action="{{ route('produk.store') }}" method="POST">
        @csrf
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" id="nama_produk">
        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi"></textarea>
        <label for="harga">Harga:</label>
        <input type="number" name="harga" id="harga" step="0.01">
        <label for="jumlah_stok">Jumlah Stok:</label>
        <input type="number" name="jumlah_stok" id="jumlah_stok">
        <button type="submit">Tambah</button>
    </form>
@endsection
