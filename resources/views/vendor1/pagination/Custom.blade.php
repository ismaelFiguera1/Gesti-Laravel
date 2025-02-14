@if ($paginator->hasPages())
    @php
        $lastPage = $paginator->lastPage();
        $current = $paginator->currentPage();
        $delta = 3; // Mostra 3 pàgines abans i 3 després del corrent
        $start = max(1, $current - $delta);
        $end = min($lastPage, $current + $delta);
    @endphp

    <nav class="custom-pagination">
        <style>
            .custom-pagination {
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 20px 0;
                font-family: Arial, sans-serif;
            }
            .custom-pagination button {
                background-color: #fff;
                color: #007bff;
                border: 1px solid #ddd;
                padding: 10px 16px;
                margin: 0 5px;
                border-radius: 6px;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
            }
            .custom-pagination button:hover:not(:disabled) {
                background-color: #f0f8ff;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
                transform: translateY(-2px);
            }
            .custom-pagination button.active {
                background-color: #007bff;
                color: #fff;
                border-color: #007bff;
                cursor: default;
                box-shadow: none;
                transform: none;
            }
            .custom-pagination button:disabled {
                color: #aaa;
                background-color: #eee;
                border-color: #ccc;
                cursor: not-allowed;
            }
            @media (max-width: 480px) {
                .custom-pagination button {
                    padding: 8px 12px;
                    font-size: 12px;
                }
            }
        </style>

        {{-- Botó "Anterior" --}}
        @if ($paginator->onFirstPage())
            <button disabled>&laquo; Anterior</button>
        @else
            <button onclick="window.location='{{ $paginator->previousPageUrl() }}'">&laquo; Anterior</button>
        @endif

        {{-- Si la finestra no comença a la pàgina 1, mostrem la pàgina 1 i "..." si cal --}}
        @if ($start > 1)
            <button onclick="window.location='{{ $paginator->url(1) }}'">1</button>
            @if ($start > 2)
                <button disabled>...</button>
            @endif
        @endif

        {{-- Botons per les pàgines dins la finestra actual --}}
        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $current)
                <button class="active" disabled>{{ $i }}</button>
            @else
                <button onclick="window.location='{{ $paginator->url($i) }}'">{{ $i }}</button>
            @endif
        @endfor

        {{-- Si la finestra no acaba amb l'última pàgina, mostrem "..." i l'última pàgina --}}
        @if ($end < $lastPage)
            @if ($end < $lastPage - 1)
                <button disabled>...</button>
            @endif
            <button onclick="window.location='{{ $paginator->url($lastPage) }}'">{{ $lastPage }}</button>
        @endif

        {{-- Botó "Següent" --}}
        @if ($paginator->hasMorePages())
            <button onclick="window.location='{{ $paginator->nextPageUrl() }}'">Següent &raquo;</button>
        @else
            <button disabled>Següent &raquo;</button>
        @endif
    </nav>
@endif
