<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Gaji Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-700">Formulir Penggajian</h3>
                        <p class="text-sm text-gray-500">Silakan pilih pegawai dan masukkan rincian gaji bulan ini.</p>
                    </div>
                    <a href="{{ route('gaji.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium">
                        &larr; Kembali ke Daftar
                    </a>
                </div>

                <hr class="mb-8 border-gray-100">

                <form action="{{ route('gaji.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-6">
                        {{-- Pilih Pegawai --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Pegawai</label>
                            <select name="pegawai_id" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition p-2.5 border" required>
                                <option value="" disabled selected>-- Cari Nama Pegawai --</option>
                                @foreach($pegawai as $p)
                                    <option value="{{ $p->id }}">{{ $p->no_pegawai }} - {{ $p->nama }}</option>
                                @endforeach
                            </select>
                            @error('pegawai_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Bulan & Tahun --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Periode (Bulan-Tahun)</label>
                            <input type="text" name="bulan_tahun" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition p-2.5 border" 
                                placeholder="Contoh: 2026-02" maxlength="7" required>
                            <p class="text-xs text-gray-400 mt-1">Gunakan format YYYY-MM (Maks 7 karakter)</p>
                        </div>

                        {{-- Gaji Pokok --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Gaji Pokok (Rp)</label>
                            <input type="number" name="gaji_pokok" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition p-2.5 border" 
                                placeholder="Masukkan nominal angka" required>
                        </div>

                        {{-- Grid untuk Tunjangan dan Pajak --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Tunjangan (Rp)</label>
                                <input type="number" name="tunjangan" value="0"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition p-2.5 border">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Potongan Pajak (Rp)</label>
                                <input type="number" name="pajak" value="0"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition p-2.5 border">
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow-lg transform transition active:scale-95 flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Simpan Transaksi Gaji
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>