<?php
// Add update method to CustomerController
$content = file_get_contents('app/Http/Controllers/CustomerController.php');
if (strpos($content, 'function update') === false) {
    $method = <<<PHP

    public function update(Request \$request, Customer \$customer)
    {
        \$request->validate([
            'nama' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'kontak' => 'required|string|max:20',
            'alamat' => 'nullable|string'
        ]);
        \$customer->update(\$request->only(['nama', 'kontak', 'alamat']));
        return back()->with('success', 'Data pelanggan berhasil diperbarui!');
    }
}
PHP;
    $content = preg_replace('/\}\s*$/', $method, $content);
    file_put_contents('app/Http/Controllers/CustomerController.php', $content);
}

// Add edit modal and button to view
$view = file_get_contents('resources/views/customers/index.blade.php');
if (strpos($view, 'Aksi') === false) {
    $view = str_replace('<th>Alamat</th>', '<th>Alamat</th><th>Aksi</th>', $view);
    
    $rowReplace = <<<HTML
                        <td>{{ \$cust->alamat }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#editCustomer{{ \$cust->id }}">Edit</button>
                            
                            <div class="modal fade" id="editCustomer{{ \$cust->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form class="modal-content" action="{{ route('customers.update', \$cust) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Pelanggan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <div class="mb-3">
                                                <label>Nama</label>
                                                <input type="text" name="nama" class="form-control" value="{{ \$cust->nama }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Kontak</label>
                                                <input type="text" name="kontak" class="form-control" value="{{ \$cust->kontak }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Alamat</label>
                                                <textarea name="alamat" class="form-control">{{ \$cust->alamat }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary-custom">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
HTML;
    $view = str_replace('<td>{{ $cust->alamat }}</td>', $rowReplace, $view);
    file_put_contents('resources/views/customers/index.blade.php', $view);
}
