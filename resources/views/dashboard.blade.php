<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="max-w-6xl mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-8">Dashboard Penjualan</h1>

        <div class="mb-6 p-4 bg-white shadow-md rounded-md flex justify-between items-center">
            <div class="text-xl font-semibold">Total Penjualan:</div>
            <div class="text-2xl font-bold text-green-600">Rp {{ number_format($total, 0, ',', '.') }}</div>
        </div>

        <form method="GET" class="mb-6 bg-white p-4 shadow-md rounded-md flex gap-4 flex-wrap items-end">
            <div>
                <label class="block text-sm text-gray-700">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="border border-gray-300 rounded px-3 py-2 w-full">
            </div>
            <div>
                <label class="block text-sm text-gray-700">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="border border-gray-300 rounded px-3 py-2 w-full">
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">Filter</button>
        </form>

        <div class="overflow-x-auto bg-white shadow-md rounded-md">
            <table class="min-w-full text-sm text-left table-auto">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2">Nama Produk</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($penjualans as $p)
                    <tr>
                        <td class="px-4 py-2">{{ $p->nama_produk }}</td>
                        <td class="px-4 py-2">{{ $p->tanggal_penjualan }}</td>
                        <td class="px-4 py-2">{{ $p->jumlah }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($p->jumlah * $p->harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @php
            $dataChart = $penjualans
                ->groupBy('tanggal_penjualan')
                ->sortKeys()
                ->map(fn($items) => $items->sum(fn($i) => $i->jumlah * $i->harga));
        @endphp

        <div class="mt-8 bg-white p-6 shadow-md rounded-md">
            <h2 class="text-xl font-semibold mb-4">Grafik Penjualan</h2>
            <canvas id="salesChart" class="w-full h-64"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($dataChart->keys()),
                datasets: [{
                    label: 'Total Penjualan (Rp)',
                    data: @json($dataChart->values()),
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    fill: true,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
