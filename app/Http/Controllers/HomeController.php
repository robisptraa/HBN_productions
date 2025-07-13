<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $packages = Package::latest()->get();
        $products = Product::latest()->get();

        return view('home.index', compact('packages', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => ['required', 'integer', 'exists:packages,id'],
            'project_desc' => ['required', 'string', 'min:3', 'max:1000'],
            'reference_path' => ['required', 'file', 'mimes:jpeg,png,jpg', 'max:2048'],
            'confirm_email' => ['required', 'email'],
            'proof_transaction_path' => ['required', 'file', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($request->hasFile('reference_path')) {
            $validated['reference_path'] = $request->file('reference_path')->store('references', 'public');
        }

        if ($request->hasFile('proof_transaction_path')) {
            $validated['proof_transaction_path'] = $request->file('proof_transaction_path')->store('proofs', 'public');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'package_id' => $validated['package_id'],
            'project_desc' => $validated['project_desc'],
            'reference_path' => $validated['reference_path'],
            'confirm_email' => $validated['confirm_email'],
            'proof_transaction_path' => $validated['proof_transaction_path'],
        ]);


        return redirect()->back()->with('success', 'Order berhasil dibuat! Kami akan segera memprosesnya.');
    }
}
