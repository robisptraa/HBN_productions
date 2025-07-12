<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Packages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('packages.create') }}"
                        class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Tambah Package
                    </a>

                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($packages as $package)
                            <div class="flex flex-col justify-between rounded-xl overflow-hidden shadow-md p-4 text-white"
                                style="background-color: {{ $package->background_color ?? '#374151' }};">
                                <div>
                                    <h3 class="text-xl font-bold mb-1">{{ $package->title }}</h3>
                                    <p class="text-sm opacity-90">{{ $package->description }}</p>
                                    <p class="text-lg font-semibold mt-3">Rp{{ number_format($package->price) }}</p>
                                    <p class="text-xs mt-1 opacity-80">Masa aktif: {{ $package->expiration_time }} hari
                                    </p>
                                </div>

                                <div class="flex justify-end gap-2 mt-6">
                                    <a href="{{ route('packages.edit', $package) }}"
                                        class="px-4 py-1.5 bg-white/90 text-yellow-600 hover:bg-white text-sm rounded font-medium transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('packages.destroy', $package) }}" method="POST"
                                        onsubmit="return confirm('Yakin mau hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="px-4 py-1.5 bg-white/90 text-red-600 hover:bg-white text-sm rounded font-medium transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-300">Belum ada package.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
