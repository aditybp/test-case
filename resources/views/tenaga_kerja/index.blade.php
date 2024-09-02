<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered Tenaga Kerja</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Filtered Tenaga Kerja</h1>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Provinsi</th>
                    <th>Kabupaten/Kota</th>
                    <th>Tenaga Kerja</th>
                    <th>Kode</th>
                    <th>Satuan</th>
                    <th>Harga OH</th>
                    <th>Harga OJ</th>
                    <th>Sumber Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tenagaKerja as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['provinsi'] }}</td> <!-- Adjust according to your data structure -->
                        <td>{{ $item['kabupaten_kota'] }}</td> <!-- Adjust according to your data structure -->
                        <td>{{ $item['tenaga_kerja'] }}</td>
                        <td>{{ $item['kode'] }}</td>
                        <td>{{ $item['satuan'] }}</td>
                        <td>{{ $item['harga_oh'] }}</td>
                        <td>{{ $item['harga_oj'] }}</td>
                        <td>{{ $item['sumber_data'] }}</td>
                    </tr>
                @endforeach
                @if($tenagaKerja->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center">No data found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
