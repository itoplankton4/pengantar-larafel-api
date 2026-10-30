
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Gambar Produk</title>
</head>
<body>
    <h2>Upload Gambar Produk</h2>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('products.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <label>Nama Produk:</label>
        <input type="text" name="name" required>

        <br><br>

        <label>Pilih Gambar:</label>
        <input type="file" name="image"
               accept="image/*" required>

        <br><br>

        <button type="submit">Upload Gambar</button>
    </form>
</body>
</html>
