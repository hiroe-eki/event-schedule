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
            
        </div>
        
        {{-- 日程入力ページへのリンク --}}
        
        {{-- イベント設定編集ページへのリンク --}}
        
    </div>
@endsection