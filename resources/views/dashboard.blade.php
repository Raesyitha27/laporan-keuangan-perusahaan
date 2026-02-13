<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Laporan Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Total Pegawai</div>
                    <div class="text-3xl font-bold">{{ $totalPegawai }}</div>
                    <a href="/pegawai" class="text-blue-500 text-sm hover:underline">Lihat Detail →</a>
                </div>
                
                </div>

           
            </div>
        </div>
    </div>
</x-app-layout>