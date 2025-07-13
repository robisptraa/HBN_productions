<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Daftar Order</h3>

                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full text-left border border-gray-200 dark:border-gray-700">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">NO</th>
                                <th class="border px-4 py-2">User</th>
                                <th class="border px-4 py-2">Paket</th>
                                <th class="border px-4 py-2">Deskripsi Proyek</th>
                                <th class="border px-4 py-2">Referensi</th>
                                <th class="border px-4 py-2">Email Konfirmasi</th>
                                <th class="border px-4 py-2">Bukti Transaksi</th>
                                <th class="border px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $index => $order)
                                <tr>
                                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="border px-4 py-2">{{ $order->user->name ?? '-' }}</td>
                                    <td class="border px-4 py-2">{{ $order->package->title ?? '-' }}</td>
                                    <td class="border px-4 py-2 break-words max-w-xs">{{ $order->project_desc }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ asset('storage/' . $order->reference_path) }}" target="_blank"
                                            class="text-blue-500 underline">
                                            Lihat
                                        </a>
                                    </td>
                                    <td class="border px-4 py-2">{{ $order->confirm_email }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ asset('storage/' . $order->proof_transaction_path) }}"
                                            target="_blank" class="text-blue-500 underline">
                                            Lihat
                                        </a>
                                    </td>
                                    <td class="flex gap-2 border px-4 py-2">
                                        <form action="{{ route('orders.verify', $order->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Verifikasi order ini?')">
                                            @csrf
                                            <button
                                                class="font-bold bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">Verifikasi</button>
                                        </form>

                                        <form action="{{ route('orders.reject', $order->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Tolak order ini?')">
                                            @csrf
                                            <button
                                                class="font-bold bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Tolak</button>
                                        </form>

                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin mau hapus order ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="font-bold bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">Belum ada order.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
