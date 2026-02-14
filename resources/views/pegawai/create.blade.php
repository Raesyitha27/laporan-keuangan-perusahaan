    <x-app-layout>
        <script src="https://cdn.tailwindcss.com"></script>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Data Pegawai') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    
                    <div class="mb-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-700">Formulir Input Pegawai</h3>
                            <p class="text-sm text-gray-500">Pastikan nomor pegawai belum terdaftar sebelumnya.</p>
                        </div>
                        <a href="{{ route('pegawai.index') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium">
                            &larr; Kembali ke Daftar
                        </a>
                    </div>

                    <hr class="mb-8 border-gray-100">

                    <form action="{{ route('pegawai.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Pegawai (Primary Key)</label>
                                <input type="text" name="no_pegawai" 
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition p-2.5 border" 
                                    placeholder="Contoh: 2026001" required>
                                @error('no_pegawai')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" 
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition p-2.5 border" 
                                    placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan</label>
                                <input type="text" name="jabatan" 
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition p-2.5 border" 
                                    placeholder="Contoh: Manager / Staff" required>
                            </div>

                            <input type="hidden" name="id" value="1"> 
                            <input type="hidden" name="nomor" value="1">
                        </div>

                        <div class="mt-10">
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow-lg transform transition active:scale-95 flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Simpan Data ke Database SQL
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </x-app-layout>