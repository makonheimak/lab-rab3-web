@extends('ecommerce-suite::layout')

@section('content')
    <div class="page-head">
        <div>
            <h1>Панель интернет-магазина</h1>
        </div>
    </div>

    <div class="grid">
        @foreach($counts as $name => $count)
            <div class="card">
                <div class="card-name">{{ $name }}</div>
                <div class="card-value">{{ $count }}</div>
            </div>
        @endforeach
    </div>
@endsection
