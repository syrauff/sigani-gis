<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

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
                        <a href="{{ route('articles.edit', $article->id) }}">Edit</a> |
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

</x-app-layout>



