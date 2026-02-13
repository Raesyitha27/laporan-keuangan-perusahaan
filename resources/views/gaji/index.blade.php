<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> Daftar Gaji Pegawai </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <a href="{{ route('gaji.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block text-sm"> + Input Gaji Baru </a>
                
                <table class="w-full mt-4 border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="border p-2">No Pegawai</th>
                            <th class="border p-2">Nama Pegawai</th>
                            <th class="border p-2">Gaji Pokok</th>
                            <th class="border p-2">Tunjangan</th>
                            <th class="border p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gaji as $g)
                    <tr class="hover:bg-gray-50 transition">
                    <td class="border p-2">{{ $g->no_pegawai }}</td>
                    <td class="border p-2">{{ $g->pegawai->nama ?? 'Pegawai Tidak Ditemukan' }}</td>
                    <td class="border p-2 text-right">Rp {{ number_format($g->gaji_pokok, 0, ',', '.') }}</td> 
                    <td class="border p-2 text-right">Rp {{ number_format($g->faktor_perubah, 0, ',', '.') }}</td>
                    <td class="border p-2 font-bold text-right text-green-700">
                        Rp {{ number_format($g->total_pendapatan, 0, ',', '.') }}
                    </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>