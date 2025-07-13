<section id="contact" class="container mx-auto px-4 py-16">
    <h2 class="text-center text-3xl font-semibold mb-8 text-gray-800 dark:text-gray-100">Kontak Kami</h2>
    <form method="POST" action="{{ route('complaints.store') }}" class="max-w-xl mx-auto space-y-6">
        @csrf

        <div>
            <label for="name" class="block mb-1 font-medium text-gray-800 dark:text-gray-100">Nama:</label>
            <input type="text" id="name" name="name" required
                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded px-4 py-2">
        </div>
        <div>
            <label for="email" class="block mb-1 font-medium text-gray-800 dark:text-gray-100">Email:</label>
            <input type="email" id="email" name="email" required
                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded px-4 py-2">
        </div>
        <div>
            <label for="message" class="block mb-1 font-medium text-gray-800 dark:text-gray-100">Pesan:</label>
            <textarea id="message" name="message" rows="5" required
                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded px-4 py-2"></textarea>
        </div>
        <button type="submit"
            class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 py-2 rounded hover:bg-gray-50 dark:hover:bg-gray-600 transition">Kirim</button>
    </form>
</section>
