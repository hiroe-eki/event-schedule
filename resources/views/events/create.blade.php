@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>イベント新規作成</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-6">
            <form method="POST" action="{{ route('events.store') }}">
                @csrf
                <div class="form-group">
                    {!! Form::label('name', 'イベント名:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('caption', 'イベント説明文:') !!}
                    {!! Form::text('caption', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('schedule', '日程:') !!}
                    {!! Form::textarea('schedule', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="mt-4 text-center">
                    {!! Form::submit('イベント作成', ['class' => 'btn btn-success btn-lg w-50']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection