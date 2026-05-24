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

    <div class="pagination">{{ $items->links() }}</div>
@endsection
