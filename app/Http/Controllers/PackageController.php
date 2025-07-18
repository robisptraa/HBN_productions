<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::latest()->get();
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
		{
				$validated = $request->validate([
						'title' => ['required', 'string', 'min:3', 'max:255'],
						'description' => ['required', 'string', 'min:3', 'max:1000'],
						'expiration_time' => ['required', 'integer'],
						'background_color' => ['required', 'string'],
						'price' => ['required', 'numeric'],
				]);

				Package::create($validated);

				return redirect()->route('packages.index')->with('success', 'Package berhasil ditambahkan!');
		}

    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
		{
				$validated = $request->validate([
						'title' => ['required', 'string', 'min:3', 'max:255'],
						'description' => ['nullable', 'string', 'min:3', 'max:1000'],
						'expiration_time' => ['required', 'integer'],
						'background_color' => ['nullable', 'string'],
						'price' => ['required', 'numeric'],
				]);

				$package->update($validated);

				return redirect()->route('packages.index')->with('success', 'Package berhasil diupdate!');
		}

    public function destroy(Package $package)
		{
				$package->delete();
				return redirect()->route('packages.index')->with('success', 'Package berhasil dihapus!');
		}
}
