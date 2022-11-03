@extends('layouts.app')

@section('content')
    <div class="center">
        <div class="text-center">
            <h1>伝助クローン</h1>
        </div>
        <div class="mt-5 text-center">
            {{-- イベント作成ページへのリンク --}}
            {!! link_to_route('events.create', 'イベントを新規作成する', [], ['class' => 'btn btn-success btn-lg w-50']) !!}
        </div>
    </div>
@endsection