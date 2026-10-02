<?php
namespace App\Http\Controllers;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::latest()->get();
        return view('admin.staff.index', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_staff' => 'required|string|max:255',
            'peran' => 'required|string|max:255',
        ]);

        Staff::create($request->only('nama_staff', 'peran'));
        return back()->with('success', 'Data staf baru berhasil ditambahkan!');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return back()->with('success', 'Data staf berhasil dihapus.');
    }
}
