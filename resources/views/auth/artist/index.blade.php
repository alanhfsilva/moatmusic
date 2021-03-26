@extends('layouts.app',["current" => 'artists'])

@section('content')
<div class="card">
    <div class="card-header">{{ __('Artists') }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <ul>
        @foreach ($artists as $item)
            <li>{{$item['name']}} ( <em>{{$item['twitter']}}</em> )</li>
        @endforeach
        </ul>
    </div>
</div>
@endsection
