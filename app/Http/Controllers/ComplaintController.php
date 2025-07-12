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

    public function destroy(Complaint $complaint){
        $complaint->delete();
        return redirect()->route('complaints.index')->with('success', 'Complaint berhasil dihapus!');
    }
}
