<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Order;
use App\Models\UserPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'package'])->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Order berhasil dihapus!');
    }

    public function verify(Order $order)
    {
        DB::transaction(function () use ($order) {
            $order->update(['status' => 'success']);

            $tanggalExpired = now()->addDays($order->package->expiration_time);

            UserPackage::create([
                'user_id' => $order->user_id,
                'package_id' => $order->package_id,
                'start_date' => now(),
                'end_date' => $tanggalExpired,
            ]);

            Notification::create([
                'user_id' => $order->user_id,
                'message' => `Order package {{ $order->package->title }} telah diverifikasi dan paket telah aktif sampai tanggal {{ $tanggalExpired }}.`,
            ]);
        });

        return redirect()->back()->with('success', 'Order berhasil diverifikasi & user telah mendapatkan paket!');
    }

    public function reject(Order $order)
    {
        $order->update(['status' => 'failed']);

        Notification::create([
            'user_id' => $order->user_id,
            'message' => `Order package {{ $order->package->title }} telah ditolak.`,
        ]);

        return redirect()->back()->with('success', 'Order telah ditolak.');
    }
}
