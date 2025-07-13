<x-app-layout>
    @if (session('success'))
        <div
            class="fixed top-1/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-200 text-green-800 p-4 rounded shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <header
        class="bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 py-16 text-center text-gray-800 dark:text-gray-100">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Selamat Datang di HBN Production</h1>
            <p class="max-w-3xl mx-auto text-lg">
                We believe that every brand has a story to tell. We specialize in crafting distinctive logos...
            </p>
            <p class="mt-4 text-md">Ready to elevate your brand? Let's get started today.</p>
        </div>
    </header>

    {{-- Portfolio --}}
    <section id="portfolio" class="container mx-auto px-4 py-10">
        <h2
            class="relative text-center text-3xl font-semibold mb-8 text-gray-800 dark:text-gray-100 after:content-[''] after:absolute after:-bottom-4 after:left-1/2 after:-translate-x-1/2 after:w-16 after:h-1 after:bg-cyan-600">
            Portofolio</h2>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 text-center">
            @forelse ($products as $product)
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <img src="{{ asset('storage/' . $product->logo_path) }}" alt="{{ $product->name }}"
                        class="w-full h-56 object-cover rounded-t-2xl">

                    <div class="p-4">
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-100 mb-2 text-center">
                            {{ $product->name }}</h3>

                        <div
                            class="text-sm text-gray-600 dark:text-gray-300 space-y-2 break-words prose dark:prose-invert">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-600 dark:text-gray-300 my-4">Belum ada portofolio.</p>
            @endforelse
        </div>
    </section>

    {{-- Packages --}}
    <section class="container mx-auto px-4 py-10">
        <h2
            class="relative text-center text-3xl font-semibold mb-8 text-gray-800 dark:text-gray-100 after:content-[''] after:absolute after:-bottom-4 after:left-1/2 after:-translate-x-1/2 after:w-16 after:h-1 after:bg-cyan-600">
            Paket Layanan Kami</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @forelse ($packages as $package)
                <div style="border: 2px solid {{ $package->background_color }}"
                    class="w-full text-center flex flex-col rounded-xl shadow hover:shadow-lg transition text-white max-w-sm mx-auto overflow-hidden">

                    <!-- Header -->
                    <div style="background-color: {{ $package->background_color }}" class="p-4">
                        <h3 class="text-2xl font-bold text-center mb-3">{{ $package->title }}</h3>
                        <div
                            class="flex justify-center items-center bg-gray-800/10 text-sm rounded-full py-1 px-3 mx-auto w-max">
                            {{ $package->expiration_time }} Hari
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="bg-white text-gray-800 dark:bg-gray-800 dark:text-gray-100 p-5 space-y-3">
                        <p class="break-words">{!! $package->description !!}</p>
                        <p>Harga: Rp. {{ number_format($package->price) }}</p>

                        <button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', { id: 'select-package', packageId: {{ $package->id }}, title: '{{ $package->title }}', expiration: '{{ $package->expiration_time }}', price: '{{ number_format($package->price) }}' })"
                            class="w-full m-2 border border-gray-300 py-2 transition rounded-xl"
                            style="color: {{ $package->background_color }}; border-color: {{ $package->background_color }};"
                            onmouseover="this.style.backgroundColor='{{ $package->background_color }}'; this.style.color='white';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='{{ $package->background_color }}';">
                            Pilih Paket
                        </button>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-600 dark:text-gray-300 my-4">Tidak ada paket layanan yang
                    tersedia.</p>
            @endforelse
        </div>
    </section>

    {{-- About --}}
    <section id="about"
        class="bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800  py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-semibold mb-6 text-gray-800 dark:text-gray-100">Tentang Kami</h2>
            <p class="max-w-3xl mx-auto text-gray-700 dark:text-gray-300">
                Hi, I'm Hiban Sakif, the creative mind behind HBN Studio Kreatif. With a passion for turning ideas into
                powerful logos and memorable brand identities, I've dedicated myself to helping businesses of all sizes
                define who they are and how they're seen by the world. Let's collaborate and make your vision come to
                life with designs that truly stand out. </p>
        </div>
    </section>

    {{-- Contact --}}
    @guest
        @include('home.partials.contact-form')
    @endguest

    @auth
        @if (auth()->user()->role->name === 'user')
            @include('home.partials.contact-form')
        @endif
    @endauth

    <footer class="bg-gray-900 dark:bg-cyan-600 text-white py-4 text-center">
        <p>&copy; 2024 HBN Production. Semua hak cipta dilindungi.</p>
    </footer>
</x-app-layout>

{{-- MODAL --}}
<div x-data="{ packageId: null, title: '', expiration: '', price: '' }"
    x-on:open-modal.window="
        if ($event.detail.id === 'select-package') {
            packageId = $event.detail.packageId
            title = $event.detail.title
            expiration = $event.detail.expiration
            price = $event.detail.price
            $dispatch('open-modal', 'select-package')
        }
    ">
    <x-modal name="select-package" :show="$errors->any()" focusable>
        <form method="POST" action="{{ route('create.order') }}" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="package_id" :value="packageId">

            <div class="text-center mb-4">
                <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                    Paket <span x-text="title"></span> ( <span x-text="expiration"></span> hari )
                </h2>
                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                    Harga: Rp. <span x-text="price"></span>
                </p>
            </div>

            <div class="mt-4">
                <x-input-label for="project_desc" value="Deskripsi Project" />
                <textarea name="project_desc" id="project_desc"
                    class="block mt-1 w-full bg-white dark:bg-gray-900 text-gray-900 dark:text-white" required></textarea>
                <x-input-error :messages="$errors->get('project_desc')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="reference_path" value="Upload Referensi" />
                <x-text-input id="reference_path" name="reference_path" type="file" class="mt-1 block w-full"
                    required />
                <x-input-label for="reference_path" value="Format: jpg, jpeg, png, max: 2MB" />
                <x-input-error :messages="$errors->get('reference_path')" class="mt-2" />
            </div>

            {{-- BORDER --}}
            <div class="w-full h-1 rounded-full bg-gray-200 dark:bg-gray-700"></div>

            <div class="text-center mb-4">
                <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                    Transfer ke Rekening Bank MANDIRI
                </h2>
                <p class="text-sm text-gray-900 dark:text-gray-100">No. Rek: 123-456-7890</p>
                <p class="text-sm text-gray-900 dark:text-gray-100">a.n. HBN-Design</p>
            </div>

            <div class="mt-4">
                <x-input-label for="confirm_email" value="Konfirmasi Email" />
                <x-text-input id="confirm_email" name="confirm_email" type="email" class="block mt-1 w-full" required
                    autofocus />
                <x-input-error :messages="$errors->get('confirm_email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="proof_transaction_path" value="Bukti Transaksi" />
                <x-text-input id="proof_transaction_path" name="proof_transaction_path" type="file"
                    class="mt-1 block w-full" required />
                <x-input-label for="proof_transaction_path" value="Format: jpg, jpeg, png, max: 2MB" />
                <x-input-error :messages="$errors->get('proof_transaction_path')" class="mt-2" />
            </div>

            <div class="flex justify-between mt-4">
                <x-secondary-button @click.prevent="step = 1">Kembali</x-secondary-button>
                <x-primary-button type="submit">Submit</x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
