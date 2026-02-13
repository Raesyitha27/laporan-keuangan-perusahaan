<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pendidikan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('pendidikan.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-bold">ID Pendidikan</label>
                        <input type="text" name="id" class="w-full border-gray-300 rounded shadow-sm" placeholder="Contoh: P01" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">Jenjang</label>
                        <input type="text" name="jenjang" class="w-full border-gray-300 rounded shadow-sm" placeholder="Contoh: S1 Akuntansi" required>
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan ke SQL</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>