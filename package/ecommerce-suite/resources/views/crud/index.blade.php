@extends('ecommerce-suite::layout')

@section('content')
    <div class="page-head">
        <div>
            <h1>{{ $title }}</h1>
        </div>
        <a class="btn" href="{{ route('ecommerce-suite.' . $routeKey . '.create') }}">Добавить</a>
    </div>

    <div class="panel">
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    @foreach($fields as $field)
                        <th>{{ $fieldLabels[$field] ?? $field }}</th>
                    @endforeach
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        @foreach($fields as $field)
                            <td>{{ Str::limit((string) data_get($item, $field), 60) }}</td>
                        @endforeach
                        <td>
                            <div class="actions">
                                <a class="btn btn-light" href="{{ route('ecommerce-suite.' . $routeKey . '.show', $item) }}">Открыть</a>
                                <a class="btn btn-light" href="{{ route('ecommerce-suite.' . $routeKey . '.edit', $item) }}">Изменить</a>
                                <form method="post" action="{{ route('ecommerce-suite.' . $routeKey . '.destroy', $item) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Удалить запись?')">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($fields) + 2 }}">Записи пока не добавлены.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($items->hasPages() || $items->total() > 0)
        <div class="pagination" style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
            <div class="muted">
                Показано {{ $items->firstItem() ?? 0 }}-{{ $items->lastItem() ?? 0 }} из {{ $items->total() }} записей
            </div>
            <div class="actions">
                @if($items->onFirstPage())
                    <span class="btn btn-light" style="opacity:.55; cursor:not-allowed;">Назад</span>
                @else
                    <a class="btn btn-light" href="{{ $items->previousPageUrl() }}">Назад</a>
                @endif

                <span class="btn btn-light" style="cursor:default;">Страница {{ $items->currentPage() }} из {{ $items->lastPage() }}</span>

                @if($items->hasMorePages())
                    <a class="btn btn-light" href="{{ $items->nextPageUrl() }}">Вперед</a>
                @else
                    <span class="btn btn-light" style="opacity:.55; cursor:not-allowed;">Вперед</span>
                @endif
            </div>
        </div>
    @endif
@endsection
