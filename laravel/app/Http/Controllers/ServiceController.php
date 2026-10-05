<?php
namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
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

    public function destroy(\App\Models\Service $service)
    {
        $service->delete();
        return back()->with('success', 'Data layanan berhasil dihapus!');
    }
}