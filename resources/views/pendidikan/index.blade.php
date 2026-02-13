<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pendidikan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ route('pendidikan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block text-sm">
                    + Tambah Jenjang
                </a>
                
                <table class="w-full mt-4 border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Jenjang Pendidikan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendidikan as $p)
                        <tr>
                            <td class="border p-2 text-center">{{ $p->id }}</td>
                            <td class="border p-2">{{ $p->jenjang }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>