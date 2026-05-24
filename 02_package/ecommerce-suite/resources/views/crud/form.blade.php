@extends('ecommerce-suite::layout')

@section('content')
    <div class="page-head">
        <div>
            <h1>{{ $title }}</h1>
        </div>
        <a class="btn btn-light" href="{{ route('ecommerce-suite.' . $routeKey . '.index') }}">Назад к списку</a>
    </div>

    <form class="panel panel-pad" method="post" action="{{ $item ? route('ecommerce-suite.' . $routeKey . '.update', $item) : route('ecommerce-suite.' . $routeKey . '.store') }}">
        @csrf
        @if($item)
            @method('PUT')
        @endif

        <div class="form-grid">
            @foreach($fields as $field)
                <div>
                    <label for="{{ $field }}">{{ $fieldLabels[$field] ?? $field }}</label>
                    <input id="{{ $field }}" name="{{ $field }}" value="{{ old($field, $item ? data_get($item, $field) : '') }}">
                    @error($field)<p class="error">Проверьте значение поля "{{ $fieldLabels[$field] ?? $field }}".</p>@enderror
                </div>
            @endforeach
        </div>

        <div style="margin-top: 20px;">
            <button class="btn">Сохранить</button>
        </div>
    </form>
@endsection
