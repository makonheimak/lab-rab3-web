@extends('ecommerce-suite::layout')

@section('content')
    <div class="page-head">
        <div>
            <h1>{{ $title }} #{{ $item->id }}</h1>
        </div>
        <div class="actions">
            <a class="btn btn-light" href="{{ route('ecommerce-suite.' . $routeKey . '.index') }}">Назад к списку</a>
            <a class="btn" href="{{ route('ecommerce-suite.' . $routeKey . '.edit', $item) }}">Изменить</a>
        </div>
    </div>

    <div class="panel">
        <div class="table-wrap">
            <table>
                <tbody>
                <tr><th>ID</th><td>{{ $item->id }}</td></tr>
                @foreach($fields as $field)
                    <tr><th>{{ $fieldLabels[$field] ?? $field }}</th><td>{{ data_get($item, $field) }}</td></tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
