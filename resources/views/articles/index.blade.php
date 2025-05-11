
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
                                        <a href="{{ route('article.show', $article->slug) }}" class="text-gray-600 hover:text-blue-600 flex items-center mx-1 space-x-1">
                                            <i class="fas fa-eye"></i>
                                            
                                        </a>
                                        
                                        {{-- Edit --}}
                                        <a href="{{ route('article.edit', $article->slug) }}" class="text-blue-600 hover:text-blue-800 flex items-center mx-1 space-x-1">
                                            <i class="fas fa-edit"></i>
                                            
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('article.destroy', $article->slug) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
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