@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>{{ $event->name }}</h1>
        <p class="mt-5">{{ $event->caption }}</p>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col col-auto border">
                <p class="font-weight-bold">日程</p>
                <div>
                    @foreach ($schedules as $schedule)
                        <div class="font-weight-bold border-top">{{ $schedule->schedule }}</div>
                    @endforeach
                </div>
            </div>
            @foreach ($guests as $guest)
                <div class="col col-auto border">
                    <p class="font-weight-bold">{{ $guest->name }}</p>
                    @foreach ($schedules as $schedule)
                        <div class="font-weight-bold border-top">○</div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="mx-auto w-50 mt-3">
            @foreach ($guests as $guest)
                {{ $guest->name }}　{{ $guest->commnent }}<br>
            @endforeach
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-6">
            <form method="POST" action="{{ route('guests.store') }}">
                @csrf
                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="d-none">
                    {!! Form::label('event_id', 'イベントID') !!}
                    {!! Form::text('event_id', $event->id, ['class' => 'form-control']) !!}
                </div>
                
                <div class="mt-4 text-center">
                    {!! Form::submit('ユーザー追加', ['class' => 'btn btn-success btn-lg w-50']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection