<?php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($search = $request->input('search')) {
            $query->where('nama_layanan', 'like', "%{$search}%");
        }

        if ($sort = $request->input('sort')) {
            if (in_array($sort, ['nama_layanan', 'harga', 'id'])) {
                $query->orderBy($sort, $request->input('order', 'asc'));
            }
        } else {
            $query->latest();
        }

        $services = $query->paginate(10)->withQueryString();
        return view('services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0'
        ]);

        Service::create($data);
        return back()->with('success', 'Layanan baru berhasil ditambahkan!');
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0'
        ]);

        $service->update($data);
        return back()->with('success', 'Data layanan berhasil diperbarui!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Data layanan berhasil dihapus!');
    }
}