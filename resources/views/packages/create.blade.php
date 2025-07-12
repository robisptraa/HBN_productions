<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Package') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl py-12 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{ route('packages.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="title" value="Judul" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required
                            autofocus />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" value="Deskripsi" />
                        <textarea name="description" class="w-full p-2 rounded bg-white dark:bg-gray-900">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="expiration_time" value="Masa Aktif (hari)" />
                        <x-text-input id="expiration_time" class="block mt-1 w-full" type="number"
                            name="expiration_time" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="background_color" value="Warna Background" />
                        <x-text-input id="background_color" class="block mt-1 w-full" type="color"
                            name="background_color" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="price" value="Harga" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01"
                            name="price" required />
                    </div>

                    <x-primary-button class="mt-4">Simpan</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
