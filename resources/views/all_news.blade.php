@extends('layouts.main')
@section('title', 'Semua Berita')
@section('content')
    <!-- News Section -->
    <section class="py-12 pb-16 bg-white" id="news">
        <div class="container mx-auto px-6">
            <h2 class="font-poppins font-semibold text-3xl text-center mb-8 text-primary">Semua Berita</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($articles as $arts)
                    <a href="{{ route('article_view', $arts->slug) }}"
                    class="block bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:shadow-xl hover:scale-[1.02]">
                        <div class="h-64 bg-green-100 relative">
                            @if ($arts->image)
                                <img src="{{ asset('storage/' . $arts->image) }}"
                                    alt="{{ $arts->title }}"
                                    class="w-full h-48 object-cover mb-4 rounded">
                            @else
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m6 12a2 2 0 01-2-2V9a2 2 0 012-2h1">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="px-6 pb-3">
                            <div class="flex items-center gap-1 text-gray-500 text-sm mt-1">
                                <i class="far fa-calendar-alt"></i>
                                <span>
                                    {{ $arts->category }} | By {{ $arts->author }} |
                                    {{ \Carbon\Carbon::parse($arts->published_at)->format('M d, Y') }}
                                </span>
                            </div>
                            <h3 class="font-poppins font-semibold text-xl mb-2 leading-tight">{{ $arts->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">
                                {{ Str::limit(strip_tags($arts->content), 150) }}
                            </p>
                            <span class="text-primary font-semibold text-sm flex items-center gap-1 hover:text-primary-dark transition-colors">
                                Baca selengkapnya
                                <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                    @empty
                        <div class="col-span-full text-center text-gray-600">
                            No news articles available.
                        </div>
                    @endforelse
                </div>
            <br>    
            <div class="container mx-auto px-6">
                <div class="flex justify-center mt-8">
                    <a href="#" class="text-primary font-semibold text-sm flex items-center gap-1 hover:text-primary-dark transition-colors">
                        Lihat semua berita
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
    </section>

    <!-- End News Section -->
@endsection