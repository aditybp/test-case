@extends('layout')

    @section('content')
    <h1>Daftar Produk</h1>
    <a href="{{ route('produk.create') }}">Tambah Produk</a>
    @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @endif
    <table>
        <tr>
            <th>Nama Produk</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Jumlah Stok</th>
            <th>Aksi</th>
        </tr>
        @foreach ($produk as $product)
            <tr>
                <td>{{ $product->nama_produk }}</td>
                <td>{{ $product->deskripsi }}</td>
                <td>{{ $product->harga }}</td>
                <td>{{ $product->jumlah_stok }}</td>
                <td>
                    <a href="{{ route('produk.show', $product->id) }}">Lihat</a>
                    <a href="{{ route('produk.edit', $product->id) }}">Edit</a>
                    <form action="{{ route('produk.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
