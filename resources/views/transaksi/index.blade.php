<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Transaksi Keuangan (Jurnal)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-green-500">
                    <p class="text-xs font-bold text-gray-500 uppercase">Total Pemasukan (Debet)</p>
                    <p class="text-xl font-bold text-green-600">Rp {{ number_format($totalDebet, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-red-500">
                    <p class="text-xs font-bold text-gray-500 uppercase">Total Pengeluaran (Kredit)</p>
                    <p class="text-xl font-bold text-red-600">Rp {{ number_format($totalKredit, 0, ',', '.') }}</p>
                </div>
                <div class="bg-indigo-600 p-6 rounded-xl shadow-sm text-white">
                    <p class="text-xs font-bold text-indigo-200 uppercase">Saldo Kas Saat Ini</p>
                    <p class="text-xl font-bold">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                                <th class="py-4 px-4 border-b text-center">Tanggal</th>
                                <th class="py-4 px-4 border-b text-left">No. Transaksi</th>
                                <th class="py-4 px-4 border-b text-left">Kode Akun</th>
                                <th class="py-4 px-4 border-b text-right">Debet (Masuk)</th>
                                <th class="py-4 px-4 border-b text-right">Kredit (Keluar)</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($transaksi as $t)
                            <tr class="hover:bg-gray-50 border-b border-gray-100">
                                <td class="py-4 px-4 text-center">{{ date('d/m/Y', strtotime($t->tanggal)) }}</td>
                                <td class="py-4 px-4 font-mono text-xs text-blue-600 font-bold">{{ $t->no_transaksi }}</td>
                                <td class="py-4 px-4">{{ $t->no_rekening }}</td>
                                <td class="py-4 px-4 text-right text-green-600 font-medium">
                                    {{ $t->debet > 0 ? 'Rp '.number_format($t->debet, 0, ',', '.') : '-' }}
                                </td>
                                <td class="py-4 px-4 text-right text-red-600 font-medium">
                                    {{ $t->kredit > 0 ? 'Rp '.number_format($t->kredit, 0, ',', '.') : '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-10 text-center text-gray-400 italic">Belum ada aktivitas transaksi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>