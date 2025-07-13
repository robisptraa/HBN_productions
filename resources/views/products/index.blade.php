<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Produk') }}
            </h2>
            <a href="{{ route('products.create') }}"
                class="px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($products as $product)
                            <div class="bg-white dark:bg-gray-900 rounded shadow p-4">
                                @if ($product->logo_path)
                                    <img src="{{ asset('storage/' . $product->logo_path) }}"
                                        class="h-32 w-full object-cover rounded mb-2">
                                @endif

                                <div class="grid grid-cols-[80%,20%] items-center w-full">
                                    <div class="w-full">
                                        <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                                        <p class="text-sm text-gray-600 w-full overflow-auto">{!! $product->description !!}
                                        </p>
                                    </div>

                                    <div class="flex flex-col justify-center items-center text-center gap-2 mt-4">
                                        <a href="{{ route('products.edit', $product) }}"
                                            class="text-yellow-600 text-sm hover:underline">Edit</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                                            onsubmit="return confirm('Yakin mau hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 text-sm hover:underline">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Tidak ada produk.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
