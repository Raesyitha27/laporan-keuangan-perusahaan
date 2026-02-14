<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan Penggajian Pegawai') }}
            </h2>

            <div class="flex items-center gap-2">
                {{-- Tombol Cetak PDF --}}
                <a href="{{ route('gaji.exportPdf', ['bulan' => request('bulan')]) }}"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow transition transform active:scale-95 text-sm flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Cetak PDF
                </a>

                {{-- Tombol Tambah Gaji --}}
                <a href="{{ route('gaji.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow transition transform active:scale-95 text-sm flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Gaji Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Bagian Filter Bulan --}}
            <div class="mb-6 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <form action="{{ route('gaji.index') }}" method="GET" class="flex items-end gap-4">
                    <div class="flex-1 max-w-xs">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Filter Bulan &
                            Tahun</label>
                        <input type="month" name="bulan" value="{{ request('bulan') }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>

                    <button type="submit"
                        class="bg-gray-800 hover:bg-black text-white px-6 py-2 rounded-lg text-sm font-bold transition shadow-sm">
                        Cari Data
                    </button>

                    @if(request('bulan'))
                        <a href="{{ route('gaji.index') }}"
                            class="text-sm text-red-600 hover:text-red-800 font-medium mb-2 transition underline decoration-2 underline-offset-4">
                            Reset Filter
                        </a>
                    @endif
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                {{-- Notifikasi Sukses --}}
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table
                        class="min-w-full table-auto border-collapse border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700 uppercase text-xs leading-normal font-bold">
                                <th class="py-3 px-4 border border-gray-200 text-center">No</th>
                                <th class="py-3 px-4 border border-gray-200 text-left">ID Pegawai</th>
                                <th class="py-3 px-4 border border-gray-200 text-left">Nama Pegawai</th>
                                <th class="py-3 px-4 border border-gray-200 text-center">Bulan-Tahun</th>
                                <th class="py-3 px-4 border border-gray-200 text-right">Gaji Pokok</th>
                                <th class="py-3 px-4 border border-gray-200 text-right">Tunjangan (Masa Kerja)</th>
                                <th class="py-3 px-4 border border-gray-200 text-right">Pajak</th>
                                <th
                                    class="py-3 px-4 border border-gray-200 text-right bg-indigo-50 font-bold text-indigo-800 italic">
                                    Total Net</th>
                                <th class="py-3 px-4 border border-gray-200 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse($allGaji as $key => $g)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                                    <td class="py-3 px-4 text-center font-medium">{{ $key + 1 }}</td>
                                    <td class="py-3 px-4 font-mono text-xs">{{ $g->pegawai->no_pegawai ?? 'N/A' }}</td>
                                    <td class="py-3 px-4 font-bold text-gray-800">{{ $g->pegawai->nama ?? 'Data Terhapus' }}
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <span
                                            class="bg-gray-100 text-gray-600 py-1 px-3 rounded-md text-xs font-bold border border-gray-200">
                                            {{ $g->bulan_tahun }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-right font-mono">Rp
                                        {{ number_format($g->gaji_pokok, 0, ',', '.') }}</td>

                                    {{-- Menampilkan Tunjangan Otomatis dari Model --}}
                                    <td class="py-3 px-4 text-right text-green-600 font-bold font-mono">
                                        + Rp {{ number_format($g->tunjangan_otomatis, 0, ',', '.') }}
                                    </td>

                                    <td class="py-3 px-4 text-right text-red-500 font-medium font-mono">- Rp
                                        {{ number_format($g->pajak, 0, ',', '.') }}</td>

                                    {{-- Perhitungan Total Net: (Gaji Pokok + Tunjangan Otomatis) - Pajak --}}
                                    <td class="py-3 px-4 text-right font-bold text-indigo-700 bg-indigo-50 font-mono">
                                        Rp
                                        {{ number_format(($g->gaji_pokok + $g->tunjangan_otomatis) - $g->pajak, 0, ',', '.') }}
                                    </td>

                                    <td class="py-3 px-4 text-center">
                                        <div class="flex items-center justify-center gap-2 text-xs">
                                            <a href="{{ route('gaji.slip', $g->id) }}"
                                                class="bg-green-100 text-green-600 px-3 py-1 rounded-md hover:bg-green-600 hover:text-white transition font-bold border border-green-200 shadow-sm">
                                                Slip
                                            </a>


                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="py-12 text-center text-gray-400 italic bg-gray-50">
                                        Belum ada data penggajian tersimpan untuk periode ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                        {{-- Footer untuk Total Seluruh Karyawan --}}
                        @if($allGaji->count() > 0)
                                                <tfoot>
                                                    <tr class="bg-gray-800 text-white font-bold">
                                                        <td colspan="7" class="py-4 px-6 text-right uppercase tracking-wider text-xs">
                                                            Total Pengeluaran Gaji
                                                            {{ request('bulan') ? 'Bulan ' . request('bulan') : 'Semua Periode' }}:
                                                        </td>
                                                        <td class="py-4 px-6 text-right bg-indigo-900 text-lg font-mono">
                                                            Rp {{ number_format($allGaji->sum(function ($item) {
                                return ($item->gaji_pokok + $item->tunjangan_otomatis) - $item->pajak;
                            }), 0, ',', '.') }}
                                                        </td>
                                                        <td class="bg-gray-800"></td>
                                                    </tr>
                                                </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>