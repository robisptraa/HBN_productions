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
    <section id="portfolio" class="container mx-auto px-4 py-16">
        <h2
            class="relative text-center text-3xl font-semibold mb-8 text-gray-800 dark:text-gray-100 after:content-[''] after:absolute after:-bottom-4 after:left-1/2 after:-translate-x-1/2 after:w-16 after:h-1 after:bg-cyan-600">
            Portofolio</h2>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach (['IMG-20240516-WA0034.jpg', 'IMG-20240516-WA0045.jpg', 'IMG-20240516-WA0025.jpg'] as $i => $img)
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded shadow hover:shadow-lg transition">
                    <img src="{{ asset('assets/img/' . $img) }}" alt="Portfolio" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-100">Project {{ $i + 1 }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Deskripsi project {{ $i + 1 }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Pricing --}}
    <section class="container mx-auto px-4 py-16">
        <h2
            class="relative text-center text-3xl font-semibold mb-8 text-gray-800 dark:text-gray-100 after:content-[''] after:absolute after:-bottom-4 after:left-1/2 after:-translate-x-1/2 after:w-16 after:h-1 after:bg-cyan-600">
            Paket Layanan Kami</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach (['Starter', 'Exclusive', 'Premium'] as $index => $name)
                <div
                    class="flex flex-col bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 shadow hover:shadow-lg transition">
                    <h3 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-100">{{ $name }} Package</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Timeline:
                        @if ($index == 0)
                            5-7 Hari
                        @elseif($index == 1)
                            3-4 Minggu
                        @else
                            12 Minggu
                        @endif
                    </p>
                    <ul class="h-full list-disc pl-5 text-sm text-gray-700 dark:text-gray-200 mb-4">
                        <li>Primary Logo</li>
                        <li>Color Palette</li>
                        <li>Typography Pairing</li>
                        @if ($index > 0)
                            <li>3D Mockups</li>
                            <li>Brand Guidelines</li>
                        @endif
                        @if ($index == 2)
                            <li>Unlimited Revisions</li>
                        @endif
                    </ul>
                    <button
                        class=" w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 py-2 rounded hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                        Pilih Paket
                    </button>
                </div>
            @endforeach
        </div>
    </section>

    {{-- About --}}
    <section id="about" class="bg-gray-100 dark:bg-gray-800 py-16">
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
        @include('welcome.partials.contact-form')
    @endguest

    @auth
        @if (auth()->user()->role->name === 'user')
            @include('welcome.partials.contact-form')
        @endif
    @endauth

    <footer class="bg-gray-900 dark:bg-cyan-600 text-white py-4 text-center">
        <p>&copy; 2024 HBN Production. Semua hak cipta dilindungi.</p>
    </footer>
</x-app-layout>
