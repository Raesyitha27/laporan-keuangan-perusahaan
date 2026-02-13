<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Bagian / Unit Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ route('bagian.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block text-sm">
                     Tambah Bagian
                </a>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full mt-4 border-collapse border border-gray-200 text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Nomor</th>
                            <th class="border p-2">Nama Bagian</th>
                            <th class="border p-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bagian as $b)
                        <tr>
                            <td class="border p-2">{{ $b->nomor }}</td>
                            <td class="border p-2">{{ $b->bagian }}</td>
                            <td class="border p-2 text-center">
                                <form action="{{ route('bagian.destroy', $b->nomor) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="border p-4 text-center text-gray-500">Belum ada data bagian di SQL.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>