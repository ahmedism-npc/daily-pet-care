<?php
$content = file_get_contents('resources/views/services/index.blade.php');
$content = str_replace('<th>Harga</th>', '<th>Harga</th><th>Aksi</th>', $content);
$replacement = <<<HTML
                        <td>Rp {{ number_format(\$svc->harga, 0, ',', '.') }}</td>
                        <td>
                            @if(auth()->user()->role === 'admin')
                            <form action="{{ route('services.destroy', \$svc) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus layanan?')">Hapus</button>
                            </form>
                            @endif
                        </td>
HTML;
$content = str_replace('<td>Rp {{ number_format($svc->harga, 0, \',\', \'.\') }}</td>', $replacement, $content);
file_put_contents('resources/views/services/index.blade.php', $content);
