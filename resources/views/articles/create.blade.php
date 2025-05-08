<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Buat Artikel Baru</h1>
    
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
    
            {{-- Judul --}}
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
    
            {{-- Konten --}}
            <div class="mb-3">
                <label for="content" class="form-label">Konten</label>
                <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
            </div>
    
            {{-- Penulis --}}
            <div class="mb-3">
                <label for="author" class="form-label">Penulis</label>
                <input type="text" name="author" id="author" class="form-control" required>
            </div>
    
            {{-- Kategori --}}
            <div class="mb-3">
                <label for="category" class="form-label">Kategori</label>
                <input type="text" name="category" id="category" class="form-control" required>
            </div>
    
            {{-- Gambar --}}
            <div class="mb-3">
                <label for="image" class="form-label">Gambar (opsional)</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
    
            {{-- Slug --}}
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" required>
            </div>
    
            {{-- Tanggal Publikasi --}}
            <div class="mb-3">
                <label for="published_at" class="form-label">Tanggal Publikasi</label>
                <input type="date" name="published_at" id="published_at" class="form-control">
            </div>
    
            {{-- Tombol Submit --}}
            <button type="submit" class="btn btn-primary">Simpan Artikel</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>