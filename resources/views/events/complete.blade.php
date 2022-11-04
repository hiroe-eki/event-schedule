@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>イベント作成完了</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('name', 'イベント名:') !!}
                <div>{{ $event->name }}</div>
            </div>
            
            <div class="form-group">
                {!! Form::label('caption', 'イベント説明文:') !!}
                <div>{{ $event->caption }}</div>
            </div>
            
            <div class="form-group">
                {!! Form::label('schedule', 'スケジュール:') !!}
                <div>
                    @foreach ($schedules as $schedule)
                        {{ $schedule->schedule }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- 日程入力ページへのリンク --}}
    <div class="mt-4 text-center">
        {!! link_to_route('events.show', '日程入力', ['token' => $event->token], ['class' => 'btn btn-success btn-lg w-50']) !!}
    </div>
        
    {{-- イベント設定編集ページへのリンク --}}
    <div class="mt-4 text-center">
        {!! link_to_route('events.edit', '設定変更', ['id' => $event->id], ['class' => 'btn btn-secondary btn-lg w-50']) !!}
    </div>
@endsection