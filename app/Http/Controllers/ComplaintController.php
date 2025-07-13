<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(){
        $complaints = Complaint::latest()->get();

        return view('complaints.index', compact('complaints'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:255'],
        ]);

        Complaint::create($validated);

        return redirect()->route('home')->with('success', 'Complaint berhasil dikirim!');
    }

    public function destroy(Complaint $complaint){
        $complaint->delete();
        return redirect()->route('complaints.index')->with('success', 'Complaint berhasil dihapus!');
    }
}
