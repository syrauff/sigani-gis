@extends('layouts.main')
@section('title', 'Sistem Pemetaan Lahan Pertanian Perkebunan Gorontalo')
@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary to-primary-dark text-white py-20">
        <div class="container mx-auto px-6 text-center max-w-4xl">
            <h1 class="font-poppins font-bold text-4xl md:text-5xl mb-4 leading-tight">Sistem Pemetaan Lahan Pertanian &amp; Perkebunan Gorontalo</h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90">Eksplorasi data spasial lahan terkini berbasis GIS</p>
            <button class="bg-white text-primary px-6 py-3 rounded font-semibold text-lg flex items-center gap-2 mx-auto hover:bg-light-gray transition-colors transform hover:-translate-y-1 hover:shadow-lg transition-all ripple" id="viewMapBtn" style="position: relative; overflow: hidden;">
                <i class="fas fa-map-marked-alt"></i>
                Lihat Peta Sekarang
            </button>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-12 bg-white" id="map">
        <div class="container mx-auto px-20">
            <h2 class="font-poppins font-semibold text-3xl text-center mb-8 text-primary">Peta Interaktif Lahan</h2>
            <div class="flex flex-col md:flex-row gap-6 shadow-lg rounded-lg overflow-hidden">
                <div class="w-full md:w-7/10 bg-light-gray relative h-[600px] md:h-auto" id="interactiveMap">
                    <div class="w-full h-full flex flex-col justify-center items-center bg-green-50" id="mapPlaceholder">
                <svg width="100%" height="100%" viewBox="0 0 800 600" xmlns="http://www.w3.org/2000/svg">
                    <rect width="800" height="600" fill="#e8f5e9"></rect>
                    
                    <!-- Water bodies -->
                    <path d="M0,300 Q200,250 400,300 T800,300 L800,600 L0,600 Z" fill="#bbdefb" opacity="0.7"></path>
                    
                    <!-- Main land -->
                    <path d="M100,100 L300,50 L500,80 L700,150 L750,300 L650,450 L500,500 L300,480 L150,400 L100,250 Z" fill="#a5d6a7" stroke="#2e7d32" stroke-width="2"></path>
                    
                    <!-- Districts -->
                    <path class="district" d="M100,100 L300,50 L350,150 L250,200 L150,180 Z" fill="#66bb6a" stroke="#2e7d32" stroke-width="1"></path>
                    <path class="district" d="M300,50 L500,80 L450,200 L350,150 Z" fill="#4caf50" stroke="#2e7d32" stroke-width="1"></path>
                    <path class="district" d="M500,80 L700,150 L600,250 L450,200 Z" fill="#66bb6a" stroke="#2e7d32" stroke-width="1"></path>
                    <path class="district" d="M150,180 L250,200 L300,300 L200,350 L100,250 Z" fill="#81c784" stroke="#2e7d32" stroke-width="1"></path>
                    <path class="district" d="M250,200 L350,150 L450,200 L400,300 L300,300 Z" fill="#4caf50" stroke="#2e7d32" stroke-width="1"></path>
                    <path class="district" d="M450,200 L600,250 L550,350 L400,300 Z" fill="#66bb6a" stroke="#2e7d32" stroke-width="1"></path>
                    <path class="district" d="M100,250 L200,350 L250,450 L150,400 Z" fill="#81c784" stroke="#2e7d32" stroke-width="1"></path>
                    <path class="district" d="M200,350 L300,300 L400,400 L300,480 L250,450 Z" fill="#4caf50" stroke="#2e7d32" stroke-width="1"></path>
                    <path class="district" d="M300,300 L400,300 L500,400 L400,400 Z" fill="#66bb6a" stroke="#2e7d32" stroke-width="1"></path>
                    <path class="district" d="M400,300 L550,350 L650,450 L500,400 Z" fill="#81c784" stroke="#2e7d32" stroke-width="1"></path>
                    <path class="district" d="M250,450 L300,480 L500,500 L400,400 Z" fill="#4caf50" stroke="#2e7d32" stroke-width="1"></path>
                    <path class="district" d="M400,400 L500,400 L650,450 L500,500 Z" fill="#66bb6a" stroke="#2e7d32" stroke-width="1"></path>
                    
                    <!-- Agricultural lands -->
                    <circle class="land" cx="200" cy="150" r="15" fill="#ffeb3b" stroke="#2e7d32" stroke-width="1" data-id="1" data-name="Kebun Kelapa Limboto" data-owner="Ahmad Dahlan" data-area="45.2" data-commodity="Kelapa"></circle>
                    <circle class="land" cx="350" cy="100" r="12" fill="#ffc107" stroke="#2e7d32" stroke-width="1" data-id="2" data-name="Sawah Padi Telaga" data-owner="Budi Santoso" data-area="32.8" data-commodity="Padi"></circle>
                    <circle class="land" cx="550" cy="120" r="18" fill="#ffeb3b" stroke="#2e7d32" stroke-width="1" data-id="3" data-name="Kebun Jagung Batudaa" data-owner="Citra Dewi" data-area="28.5" data-commodity="Jagung"></circle>
                    <circle class="land" cx="180" cy="280" r="14" fill="#f44336" stroke="#2e7d32" stroke-width="1" data-id="4" data-name="Perkebunan Kelapa Boalemo" data-owner="Dani Pratama" data-area="87.3" data-commodity="Kelapa"></circle>
                    <circle class="land" cx="320" cy="220" r="16" fill="#ffeb3b" stroke="#2e7d32" stroke-width="1" data-id="5" data-name="Lahan Jagung Gorontalo Utara" data-owner="Eko Widodo" data-area="56.1" data-commodity="Jagung"></circle>
                    <circle class="land" cx="480" cy="150" r="13" fill="#ffc107" stroke="#2e7d32" stroke-width="1" data-id="6" data-name="Sawah Bone Bolango" data-owner="Fajar Nugroho" data-area="22.4" data-commodity="Padi"></circle>
                    <circle class="land" cx="580" cy="300" r="17" fill="#ffeb3b" stroke="#2e7d32" stroke-width="1" data-id="7" data-name="Kebun Kelapa Pohuwato" data-owner="Gita Purnama" data-area="65.7" data-commodity="Kelapa"></circle>
                    <circle class="land" cx="250" cy="380" r="15" fill="#f44336" stroke="#2e7d32" stroke-width="1" data-id="8" data-name="Lahan Jagung Tilamuta" data-owner="Hendra Wijaya" data-area="34.2" data-commodity="Jagung"></circle>
                    <circle class="land" cx="400" cy="350" r="14" fill="#ffc107" stroke="#2e7d32" stroke-width="1" data-id="9" data-name="Perkebunan Padi Kwandang" data-owner="Indra Kusuma" data-area="41.8" data-commodity="Padi"></circle>
                    <circle class="land" cx="500" cy="450" r="16" fill="#ffeb3b" stroke="#2e7d32" stroke-width="1" data-id="10" data-name="Kebun Jagung Paguyaman" data-owner="Joko Susilo" data-area="29.6" data-commodity="Jagung"></circle>
                    
                    <!-- Cities/Towns -->
                    <circle cx="200" cy="150" r="5" fill="#ffffff" stroke="#2e7d32" stroke-width="1"></circle>
                    <text x="200" y="135" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">Limboto</text>
                    
                    <circle cx="350" cy="100" r="5" fill="#ffffff" stroke="#2e7d32" stroke-width="1"></circle>
                    <text x="350" y="85" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">Telaga</text>
                    
                    <circle cx="550" cy="120" r="5" fill="#ffffff" stroke="#2e7d32" stroke-width="1"></circle>
                    <text x="550" y="105" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">Batudaa</text>
                    
                    <circle cx="180" cy="280" r="5" fill="#ffffff" stroke="#2e7d32" stroke-width="1"></circle>
                    <text x="180" y="265" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">Boalemo</text>
                    
                    <circle cx="480" cy="150" r="5" fill="#ffffff" stroke="#2e7d32" stroke-width="1"></circle>
                    <text x="480" y="135" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">Bone Bolango</text>
                    
                    <circle cx="320" cy="220" r="5" fill="#ffffff" stroke="#2e7d32" stroke-width="1"></circle>
                    <text x="320" y="205" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">Gorontalo</text>
                    
                    <!-- Compass -->
                    <circle cx="730" cy="70" r="30" fill="#ffffff" stroke="#2e7d32" stroke-width="1" opacity="0.8"></circle>
                    <path d="M730,40 L730,100 M700,70 L760,70" stroke="#2e7d32" stroke-width="1"></path>
                    <text x="730" y="55" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">U</text>
                    <text x="745" y="75" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">T</text>
                    <text x="730" y="90" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">S</text>
                    <text x="715" y="75" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">B</text>
                    
                    <!-- Scale -->
                    <rect x="650" y="550" width="100" height="10" fill="#ffffff" stroke="#2e7d32" stroke-width="1"></rect>
                    <text x="700" y="540" font-size="12" text-anchor="middle" fill="#2e7d32">10 km</text>
                </svg>
            </div>
                    <div class="tooltip" id="mapTooltip">Gunakan panel di sebelah kanan untuk filter data</div>
                    <div class="absolute bottom-4 right-4 flex flex-col gap-2">
                        <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-light-gray transition-colors" id="zoomIn">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-light-gray transition-colors" id="zoomOut">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="w-full md:w-3/10 bg-white border-l border-gray-200 p-6 overflow-y-auto">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="font-poppins text-lg font-semibold mb-4 text-primary flex items-center gap-2">
                            <i class="fas fa-filter"></i> Filter Data
                        </h3>
                        <div class="mb-4">
                            <label for="komoditas" class="block mb-2 font-semibold text-sm">Komoditas</label>
                            <select id="komoditas" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                                <option value="" selected="selected">Semua Komoditas</option>
                                <option value="kelapa">Kelapa</option>
                                <option value="jagung">Jagung</option>
                                <option value="padi">Padi</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="luasLahan" class="block mb-2 font-semibold text-sm">Luas Lahan (Hektar)</label>
                            <input type="range" id="luasLahan" min="1" max="100" value="50" class="w-full">
                            <div class="flex justify-between mt-1 text-sm">
                                <span>1 ha</span>
                                <span id="luasValue">50 ha</span>
                                <span>100 ha</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 mt-4">
                            <input type="checkbox" id="lahanBermasalah" class="w-4 h-4">
                            <label for="lahanBermasalah">Tampilkan Lahan Bermasalah</label>
                        </div>
                        <button class="w-full bg-primary text-white py-3 px-4 rounded font-semibold mt-4 hover:bg-primary-dark transition-colors ripple">Terapkan Filter</button>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="font-poppins text-lg font-semibold mb-4 text-primary flex items-center gap-2">
                            <i class="fas fa-info-circle"></i> Legenda
                        </h3>
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 bg-primary-light rounded"></div>
                                <span>Lahan Aktif</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 bg-warning rounded"></div>
                                <span>Lahan Tidak Produktif</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 bg-danger rounded"></div>
                                <span>Lahan Bermasalah</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 bg-gray-400 rounded"></div>
                                <span>Bukan Lahan Pertanian</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="font-poppins text-lg font-semibold mb-4 text-primary flex items-center gap-2">
                            <i class="fas fa-chart-bar"></i> Statistik
                        </h3>
                        <p class="mb-2">Total Lahan: <strong>1,245</strong></p>
                        <p class="mb-2">Total Luas: <strong>8,750 ha</strong></p>
                        <p>Komoditas Dominan: <strong>Jagung (45%)</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Table Section -->
    <section class="py-12 bg-light-gray" id="data">
        <div class="container mx-auto px-6">
            <h2 class="font-poppins font-semibold text-3xl text-center mb-8 text-primary">Sumber Data Lahan</h2>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex flex-col md:flex-row justify-between gap-4">
                    <div class="bg-light-gray rounded flex items-center px-4 py-2 w-full md:w-auto">
                        <i class="fas fa-search text-gray-500 mr-2"></i>
                        <input type="text" placeholder="Cari data lahan..." class="bg-transparent border-none focus:outline-none w-full">
                    </div>
                    <button class="bg-primary text-white px-4 py-2 rounded font-semibold flex items-center gap-2 hover:bg-primary-dark transition-colors ripple">
                        <i class="fas fa-download"></i>
                        Export Data
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full data-table">
                        <thead>
                            <tr class="bg-light-gray">
                                <th class="text-left p-4 font-semibold">Nama Lahan</th>
                                <th class="text-left p-4 font-semibold">Lokasi</th>
                                <th class="text-left p-4 font-semibold">Luas (ha)</th>
                                <th class="text-left p-4 font-semibold hidden md:table-cell">Sumber Data</th>
                                <th class="text-left p-4 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-green-50 transition-colors">
                                <td class="p-4 border-b border-gray-200"><a href="#" class="text-primary font-semibold hover:underline">Kebun Kelapa Limboto</a></td>
                                <td class="p-4 border-b border-gray-200">Limboto, Desa Hutadaa</td>
                                <td class="p-4 border-b border-gray-200">45.2</td>
                                <td class="p-4 border-b border-gray-200 hidden md:table-cell">BPN</td>
                                <td class="p-4 border-b border-gray-200"><span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-success">Aktif</span></td>
                            </tr>
                            <tr class="bg-light-gray hover:bg-green-50 transition-colors">
                                <td class="p-4 border-b border-gray-200"><a href="#" class="text-primary font-semibold hover:underline">Sawah Padi Telaga</a></td>
                                <td class="p-4 border-b border-gray-200">Telaga, Desa Bulila</td>
                                <td class="p-4 border-b border-gray-200">32.8</td>
                                <td class="p-4 border-b border-gray-200 hidden md:table-cell">Kementan</td>
                                <td class="p-4 border-b border-gray-200"><span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-success">Aktif</span></td>
                            </tr>
                            <tr class="hover:bg-green-50 transition-colors">
                                <td class="p-4 border-b border-gray-200"><a href="#" class="text-primary font-semibold hover:underline">Kebun Jagung Batudaa</a></td>
                                <td class="p-4 border-b border-gray-200">Batudaa, Desa Iluta</td>
                                <td class="p-4 border-b border-gray-200">28.5</td>
                                <td class="p-4 border-b border-gray-200 hidden md:table-cell">Pemda</td>
                                <td class="p-4 border-b border-gray-200"><span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-danger">Non-Aktif</span></td>
                            </tr>
                            <tr class="bg-light-gray hover:bg-green-50 transition-colors">
                                <td class="p-4 border-b border-gray-200"><a href="#" class="text-primary font-semibold hover:underline">Perkebunan Kelapa Boalemo</a></td>
                                <td class="p-4 border-b border-gray-200">Boalemo, Desa Dulupi</td>
                                <td class="p-4 border-b border-gray-200">87.3</td>
                                <td class="p-4 border-b border-gray-200 hidden md:table-cell">BPN</td>
                                <td class="p-4 border-b border-gray-200"><span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-success">Aktif</span></td>
                            </tr>
                            <tr class="hover:bg-green-50 transition-colors">
                                <td class="p-4 border-b border-gray-200"><a href="#" class="text-primary font-semibold hover:underline">Lahan Jagung Gorontalo Utara</a></td>
                                <td class="p-4 border-b border-gray-200">Gorontalo Utara, Desa Bulalo</td>
                                <td class="p-4 border-b border-gray-200">56.1</td>
                                <td class="p-4 border-b border-gray-200 hidden md:table-cell">Kementan</td>
                                <td class="p-4 border-b border-gray-200"><span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-success">Aktif</span></td>
                            </tr>
                            <tr class="bg-light-gray hover:bg-green-50 transition-colors">
                                <td class="p-4 border-b border-gray-200"><a href="#" class="text-primary font-semibold hover:underline">Sawah Bone Bolango</a></td>
                                <td class="p-4 border-b border-gray-200">Bone Bolango, Desa Toto Utara</td>
                                <td class="p-4 border-b border-gray-200">22.4</td>
                                <td class="p-4 border-b border-gray-200 hidden md:table-cell">Pemda</td>
                                <td class="p-4 border-b border-gray-200"><span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-danger">Non-Aktif</span></td>
                            </tr>
                            <tr class="hover:bg-green-50 transition-colors">
                                <td class="p-4 border-b border-gray-200"><a href="#" class="text-primary font-semibold hover:underline">Kebun Kelapa Pohuwato</a></td>
                                <td class="p-4 border-b border-gray-200">Pohuwato, Desa Bumela</td>
                                <td class="p-4 border-b border-gray-200">65.7</td>
                                <td class="p-4 border-b border-gray-200 hidden md:table-cell">BPN</td>
                                <td class="p-4 border-b border-gray-200"><span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-success">Aktif</span></td>
                            </tr>
                            <tr class="bg-light-gray hover:bg-green-50 transition-colors">
                                <td class="p-4 border-b border-gray-200"><a href="#" class="text-primary font-semibold hover:underline">Lahan Jagung Tilamuta</a></td>
                                <td class="p-4 border-b border-gray-200">Boalemo, Desa Tilamuta</td>
                                <td class="p-4 border-b border-gray-200">34.2</td>
                                <td class="p-4 border-b border-gray-200 hidden md:table-cell">Kementan</td>
                                <td class="p-4 border-b border-gray-200"><span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-success">Aktif</span></td>
                            </tr>
                            <tr class="hover:bg-green-50 transition-colors">
                                <td class="p-4 border-b border-gray-200"><a href="#" class="text-primary font-semibold hover:underline">Perkebunan Padi Kwandang</a></td>
                                <td class="p-4 border-b border-gray-200">Gorontalo Utara, Desa Kwandang</td>
                                <td class="p-4 border-b border-gray-200">41.8</td>
                                <td class="p-4 border-b border-gray-200 hidden md:table-cell">Pemda</td>
                                <td class="p-4 border-b border-gray-200"><span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-danger">Non-Aktif</span></td>
                            </tr>
                            <tr class="bg-light-gray hover:bg-green-50 transition-colors">
                                <td class="p-4 border-b border-gray-200"><a href="#" class="text-primary font-semibold hover:underline">Kebun Jagung Paguyaman</a></td>
                                <td class="p-4 border-b border-gray-200">Boalemo, Desa Paguyaman</td>
                                <td class="p-4 border-b border-gray-200">29.6</td>
                                <td class="p-4 border-b border-gray-200 hidden md:table-cell">BPN</td>
                                <td class="p-4 border-b border-gray-200"><span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-success">Aktif</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-6 flex justify-center items-center gap-2">
                    <button class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded hover:bg-light-gray transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded bg-primary text-white">1</button>
                    <button class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded hover:bg-light-gray transition-colors">2</button>
                    <button class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded hover:bg-light-gray transition-colors">3</button>
                    <button class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded hover:bg-light-gray transition-colors">4</button>
                    <button class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded hover:bg-light-gray transition-colors">5</button>
                    <button class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded hover:bg-light-gray transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-12 pb-16 bg-white" id="news">
    <div class="container mx-auto px-6">
        <h2 class="font-poppins font-semibold text-3xl text-center mb-8 text-primary">Berita Terkini</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($articles as $arts)
                <a href="{{ route('article_view', $arts->slug) }}"
                   class="group block bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:shadow-xl hover:scale-[1.02]">
                    <div class="h-48 bg-green-100 relative">
                        @if ($arts->image)
                            <img src="{{ asset('storage/' . $arts->image) }}"
                                 alt="{{ $arts->title }}"
                                 class="w-full h-48 object-cover mb-4">
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
                    <div class="px-6 pb-6">
                        <div class="flex items-center gap-1 text-gray-500 text-sm mb-2">
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
                        <span class="text-primary font-semibold text-sm flex items-center gap-1 group-hover:text-primary-dark transition-colors">
                            Baca selengkapnya
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center  text-gray-600">
                    Tidak Ada Berita Tersedia.
                </div>
            @endforelse
        </div>
        <div class="flex justify-center mt-8">
            <a href="{{ route('all-news') }}" class="text-primary font-semibold text-sm flex items-center gap-1 hover:text-primary-dark transition-colors">
                Lihat semua berita
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

@endsection