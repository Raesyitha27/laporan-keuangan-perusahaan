<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Laporan Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                {{-- Card Total Pegawai --}}
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Total Pegawai</div>
                    <div class="text-3xl font-bold">{{ $totalPegawai }}</div>
                    <a href="/pegawai" class="text-blue-500 text-sm hover:underline">Lihat Detail →</a>
                </div>

                {{-- Card Total Pengeluaran Gaji --}}
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Total Pengeluaran Gaji</div>
                    <div class="text-3xl font-bold text-green-600">
                        Rp {{ number_format($totalGaji, 0, ',', '.') }}
                    </div>
                    <a href="/gaji" class="text-green-500 text-sm hover:underline">Lihat Laporan Gaji →</a>
                </div>
                
                {{-- Card Tambahan (Opsional: Misal Rata-rata Gaji) --}}
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-purple-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Periode Aktif</div>
                    <div class="text-3xl font-bold">{{ date('F Y') }}</div>
                    <div class="text-gray-400 text-xs">Status: Penggajian Berjalan</div>
                </div>
            </div>

            {{-- Bagian Tabel atau Grafik bisa ditaruh di bawah sini --}}
        </div>
    </div>
</x-app-layout>