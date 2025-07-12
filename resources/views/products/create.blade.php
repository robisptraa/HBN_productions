<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="name" value="Nama Produk" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" value="Deskripsi" />
                            <textarea id="description" name="description" rows="4"
                                class="mt-1 block w-full bg-white dark:bg-gray-900 rounded">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="logo_path" value="Logo Produk" />
                            <x-text-input id="logo_path" name="logo_path" type="file" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('logo_path')" class="mt-2" />
                        </div>

                        <x-primary-button>Simpan</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
