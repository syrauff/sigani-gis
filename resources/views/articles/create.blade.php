<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <a href="{{ route('article.index') }}" class="text-gray-600 hover:text-gray-800">
                <!-- Ikon panah kiri -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Buat Artikel Baru') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-md rounded-lg">
                <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-medium mb-2">Judul</label>
                        <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500" required>
                        @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 font-medium mb-2">Konten</label>
                        <textarea name="content" id="content" rows="5" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500" required></textarea>
                        @error('content')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="author" class="block text-gray-700 font-medium mb-2">Penulis</label>
                        <input type="text" name="author" id="author" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500" required>
                         @error('author')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror    
                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 font-medium mb-2">Kategori</label>
                        <input type="text" name="category" id="category" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500" required>
                        @error('category')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="published_at" class="block text-sm font-medium text-gray-700 my-2">Tanggal Publikasi</label>
                        <input 
                            type="datetime-local" 
                            id="published_at" 
                            name="published_at" 
                            class="w-full p-2 border border-gray-300 rounded-md" 
                            required 
                            value="{{ date('Y-m-d\TH:i') }}" />
                        @error('published_at')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="slug" class="block text-gray-700 font-medium mb-2">Slug (Otomatis dari judul)</label>
                        <input type="text" name="slug" id="slug" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500" required readonly>
                        @error('slug') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>  


                    <div class="mb-6">
                        <label for="image" class="block text-gray-700 font-medium mb-2">Gambar</label>
                        <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-500">
                        @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>
                            {{ __('Simpan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Script untuk membuat slug otomatis --}}
    <script>
        document.getElementById('title').addEventListener('input', function () {
            const title = this.value;
            const slug = title
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')    // Hapus karakter aneh
                .replace(/\s+/g, '-')            // Ganti spasi jadi strip
                .replace(/-+/g, '-');            // Hapus strip berulang
            document.getElementById('slug').value = slug;
        });
    </script>
</x-app-layout>
