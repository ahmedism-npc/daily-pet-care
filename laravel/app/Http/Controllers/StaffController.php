<?php
namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $query = Staff::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('nama_staff', 'like', "%{$search}%")
                  ->orWhere('peran', 'like', "%{$search}%");
            });
        }

        if ($sort = $request->input('sort')) {
            if (in_array($sort, ['nama_staff', 'peran', 'id'])) {
                $query->orderBy($sort, $request->input('order', 'asc'));
            }
        } else {
            $query->latest();
        }

        $staff = $query->paginate(10)->withQueryString();
        return view('admin.staff.index', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_staff' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'peran' => 'required|string|max:255',
        ]);

        Staff::create($request->only('nama_staff', 'peran'));
        return back()->with('success', 'Data staf baru berhasil ditambahkan!');
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'nama_staff' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'peran' => 'required|string|max:255',
        ]);

        $staff->update($request->only('nama_staff', 'peran'));
        return back()->with('success', 'Data staf berhasil diperbarui!');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return back()->with('success', 'Data staf berhasil dihapus.');
    }
}
