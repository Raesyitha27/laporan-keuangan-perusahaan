<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                
                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-700">Tambah Data Pegawai</h3>
                    <a href="{{ route('pegawai.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">&larr; Kembali</a>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pegawai.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Pegawai</label>
                            <input type="text" name="no_pegawai" value="{{ old('no_pegawai') }}" class="w-full border-gray-300 rounded-lg p-2.5 border" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border-gray-300 rounded-lg p-2.5 border" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan</label>
                            <input type="text" name="jabatan" value="{{ old('jabatan') }}" class="w-full border-gray-300 rounded-lg p-2.5 border" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" class="w-full border-gray-300 rounded-lg p-2.5 border" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pendidikan</label>
                            <select name="pendidikan_id" class="w-full border-gray-300 rounded-lg p-2.5 border" required>
                                <option value="">-- Pilih --</option>
                                @foreach(\App\Models\Pendidikan::all() as $p)
                                    <option value="{{ $p->id }}" {{ old('pendidikan_id') == $p->id ? 'selected' : '' }}>{{ $p->jenjang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Bagian</label>
                            <select name="bagian_id" class="w-full border-gray-300 rounded-lg p-2.5 border" required>
                                <option value="">-- Pilih --</option>
                                @foreach(\App\Models\Bagian::all() as $b)
                                    <option value="{{ $b->nomor }}" {{ old('bagian_id') == $b->nomor ? 'selected' : '' }}>{{ $b->bagian }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow-lg">
                            Simpan Data Pegawai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>