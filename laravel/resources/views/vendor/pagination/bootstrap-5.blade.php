@if ($paginator->total() > 0)
    <nav class="d-flex justify-content-between align-items-center flex-wrap gap-2 py-2">
        <div class="small text-muted">
            Menampilkan <span class="fw-semibold text-body">{{ $paginator->firstItem() }}</span>
            sampai <span class="fw-semibold text-body">{{ $paginator->lastItem() }}</span>
            dari <span class="fw-semibold text-body">{{ $paginator->total() }}</span> data
        </div>

        <div>
            <ul class="pagination pagination-sm m-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="Sebelumnya">
                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Sebelumnya">&lsaquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @if ($paginator->hasPages())
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @else
                    {{-- Hanya 1 halaman: tetap tampilkan tombol angka 1 agar visual paginasi jelas --}}
                    <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Berikutnya">&rsaquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="Berikutnya">
                        <span class="page-link" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@endif
