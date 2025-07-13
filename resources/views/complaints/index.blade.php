<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Keluhan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Daftar Keluhan</h3>

                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full text-left border border-gray-200 dark:border-gray-700">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">NO</th>
                                <th class="border px-4 py-2">Nama</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Keluhan</th>
                                <th class="border px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($complaints as $index => $complaint)
                                <tr>
                                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="border px-4 py-2">{{ $complaint->name ?? '-' }}</td>
                                    <td class="border px-4 py-2">{{ $complaint->email }}</td>
                                    <td class="border px-4 py-2 break-words max-w-xs">{{ $complaint->message }}</td>
                                    <td class="border px-4 py-2">
                                        <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin mau hapus keluhan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Belum ada keluhan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
