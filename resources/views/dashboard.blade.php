<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <select id="filterKabupaten"></select>
        <select id="filterKecamatan"></select>
        <button onclick="loadGeoJSON()">Tampilkan</button>
            <div class="p-16 m-6 shadow-sm bg-white sm:rounded-lg">
                <div class="flex border border-red-500">
                    <div class="w-1/2 flex flex-col  items-center">
                        <div class="h-96">
                            <canvas id="kelasChart"></canvas>
                        </div>
                        <div class="h-96">
                            <canvas id="kategoriChart"></canvas>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <canvas id="jTanamChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        let allFeatures = [];
        let kelasChartInstance = null;
        let kategoriChartInstance = null;
        let jTanamChartInstance = null;

        async function loadDropdownOptions(){
            const response = await fetch('assets/maps/data_GorontaloUtara.geojson');
            const geojson = await response.json();
            allFeatures = geojson.features;

            const kabupatenSet = new Set();
            const kecamatanSet = new Set();

            allFeatures.forEach(feature => {
                kabupatenSet.add(feature.properties.WADMKK);
                kecamatanSet.add(feature.properties.NAMOBJ);
            });

            const kabupatenDropdown = document.getElementById('filterKabupaten');
            const kecamatanDropdown = document.getElementById('filterKecamatan');

            kabupatenDropdown.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
            kecamatanDropdown.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

            Array.from(kabupatenSet).sort().forEach(kab => {
                kabupatenDropdown.innerHTML += `<option value="${kab}">${kab}</option>`;
            });

            Array.from(kecamatanSet).sort().forEach(kec => {
                kecamatanDropdown.innerHTML += `<option value="${kec}">${kec}</option>`;
            });
        }
        
        function loadGeoJSON() {
            const targetKecamatan = document.getElementById('filterKecamatan').value;
            const targetKabupaten = document.getElementById('filterKabupaten').value;

            const kelasCounts = {};
            const jTanamCounts = {};
            const kategoriCounts = {};


            allFeatures.forEach(feature => {
                const props = feature.properties;

                // Jika dropdown kosong (''), maka tidak difilter
                const matchKecamatan = !targetKecamatan || props.NAMOBJ === targetKecamatan;
                const matchKabupaten = !targetKabupaten || props.WADMKK === targetKabupaten;

                if (matchKecamatan && matchKabupaten) {
                    const kelas = props.KELAS;
                    const jTanam = props.J_Tanam;
                    const kategori = props.KATEGORI;

                    if (kelas) {
                        kelasCounts[kelas] = (kelasCounts[kelas] || 0) + 1;
                    }

                    if (jTanam) {
                        jTanamCounts[jTanam] = (jTanamCounts[jTanam] || 0) + 1;
                    }

                    if (kategori) {
                        kategoriCounts[kategori] = (kategoriCounts[kategori] || 0) + 1;
                    }      

                }
            });

            const labelsKelas = Object.keys(kelasCounts);
            const dataKelas = Object.values(kelasCounts);

            const labelsJTanam = Object.keys(jTanamCounts);
            const dataJTanam = Object.values(jTanamCounts);

            const labelsKategori = Object.keys(kategoriCounts);
            const dataKategori = Object.values(kategoriCounts);

            renderPieChart(labelsKelas, dataKelas);
            renderBarChart(labelsJTanam, dataJTanam);
            renderKategoriChart(labelsKategori, dataKategori);
        }

            function renderPieChart(labels, data) {
                const ctx = document.getElementById('kelasChart').getContext('2d');

                if (kelasChartInstance) {
                    kelasChartInstance.destroy();
                }

                kelasChartInstance = new Chart(ctx, {
                    type: 'pie',
                    data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah',
                        data: data,
                        backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#8BC34A',
                        '#9C27B0', '#00BCD4', '#FF9800', '#795548'
                        ],
                        borderWidth: 1
                    }]
                    },
                    options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false // matikan legend bawaan
                                },
                                title: {
                                    display: true,
                                    text: 'Distribusi KELAS'
                                },
                                datalabels: {
                                    color: '#fff',
                                    formatter: (value, ctx) => {
                                        const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                        const percentage = (value / total * 100).toFixed(1); // satu angka desimal
                                        return `${ctx.chart.data.labels[ctx.dataIndex]} \n ${percentage}%`;
                                    },
                                    font: {
                                        weight: 'bold',
                                        size: 14
                                    }
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                });
            }

            function renderKategoriChart(labels, data) {
                const ctx = document.getElementById('kategoriChart').getContext('2d');

                if (kategoriChartInstance) {
                    kategoriChartInstance.destroy();
                }

                kategoriChartInstance = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah',
                            data: data,
                            backgroundColor: [
                                '#FF6384', '#36A2EB', '#FFCE56', '#8BC34A',
                                '#9C27B0', '#00BCD4', '#FF9800', '#795548'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Distribusi KATEGORI'
                            },
                            datalabels: {
                                color: '#fff',
                                formatter: (value, ctx) => {
                                    const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                    const percentage = (value / total * 100).toFixed(1);
                                    return `${ctx.chart.data.labels[ctx.dataIndex]}\n${percentage}%`;
                                },
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                display: 'auto',
                                align: 'center',
                                anchor: 'center'
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            }

            function renderBarChart(labels, data) {
                const ctx = document.getElementById('jTanamChart').getContext('2d');

                    if (jTanamChartInstance) {
                        jTanamChartInstance.destroy();
                    }

                    jTanamChartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah',
                            data: data,
                            backgroundColor: [
                                    '#1B5E20', 
                                    '#2E7D32',
                                    '#388E3C',
                                    '#43A047',
                                    '#4CAF50',
                                    '#66BB6A',
                                    '#81C784',
                                    '#A5D6A7' 
                            ],
                            borderColor: '#333',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Distribusi J_Tanam'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });
            }
            window.onload = () => {
                loadDropdownOptions();
            };
        // Jalankan
        loadGeoJSON();

    </script>

</x-app-layout>
