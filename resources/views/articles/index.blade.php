<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Article</h1>
    <a href="{{ route('articles.create') }}">Create</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Category</th>
                <th>Image</th>
                <th>Slug</th>
                <th>Published At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->content }}</td>
                    <td>{{ $article->author }}</td>
                    <td>{{ $article->category }}</td>
                    <td><img src="{{ asset('storage/' . $article->image) }}" alt="Image" width="100"></td>
                    <td>{{ $article->slug }}</td>
                    <td>{{ $article->published_at }}</td>
                    <td>
                        <a href="{{ route('articles.edit', $article->slug) }}">Edit</a> |
                        <form action="{{ route('articles.destroy', $article->slug) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
</body>
</html>
=======
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Heading and Create Button -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Article List</h1>
                <x-primary-button class="ms-3">
                    <a href="{{ route('article.create') }}" >
                    {{ __('Create Article') }}
                    </a>
                </x-primary-button>
                
            </div>

            <!-- Table -->
            <div class="bg-white shadow overflow-hidden rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Title</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Content</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Author</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Category</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Image</th>
                    
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Published At</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($articles as $article)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $article->id }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $article->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ Str::limit($article->content, 50) }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $article->author }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $article->category }}</td>
                                <td class="px-1 py-3">
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="Image" class="w-20 h-14 object-cover rounded">
                                </td>
                                
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $article->published_at }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex justify-between items-center">
                                        {{-- View --}}
                                        <a href="{{ route('article.show', $article->id) }}" class="text-gray-600 hover:text-blue-600 flex items-center mx-1 space-x-1">
                                            <i class="fas fa-eye"></i>
                                            
                                        </a>
                                        
                                        {{-- Edit --}}
                                        <a href="{{ route('article.edit', $article->id) }}" class="text-blue-600 hover:text-blue-800 flex items-center mx-1 space-x-1">
                                            <i class="fas fa-edit"></i>
                                            
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('article.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 flex items-center mx-1 space-x-1">
                                                <i class="fas fa-trash-alt"></i>
                                                
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
>>>>>>> e187f3f659f9985c7d1c33182d61e7e399fff100
