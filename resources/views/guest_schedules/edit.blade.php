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
                        <div class="font-weight-bold border-top" style="height: 95px;">{{ $schedule->schedule }}</div>
                    @endforeach
                </div>
            </div>
            <div class="col col-auto border pl-4 pr-4">
                <p class="font-weight-bold">
                    {{ $guest->name }}
                </p>
                @foreach ($schedules as $schedule)
                    <div class="form-group row justify-content-center">
                        @php
                            $prefferrd = $schedule->get_preferred($guest->id);
                        @endphp
                        @if($prefferrd == "○")
                            <!-- ○の選択状態表示 -->
                            <form action="{{ route('guest_schedules.update', ['token' => $event->token, 'guest_id' =>$guest->id, 'schedule_id'=>$schedule->id]) }}" method="post">
                                @csrf
                                {!! Form::hidden('preferred', "なし") !!}
                                <div class="mt-4 text-center">
                                    {!! Form::submit('○', ['class' => 'btn btn-success btn-lg']) !!}
                                </div>
                            {!! Form::close() !!}
                        @else
                            <!-- ○の非選択状態表示 -->
                            <form action="{{ route('guest_schedules.update', ['token' => $event->token, 'guest_id' =>$guest->id, 'schedule_id'=>$schedule->id]) }}" method="post">
                                @csrf
                                {!! Form::hidden('preferred', "○") !!}
                                <div class="mt-4 text-center">
                                    {!! Form::submit('○', ['class' => 'btn btn-secondary btn-lg']) !!}
                                </div>
                            {!! Form::close() !!}
                        @endif
                       @if($prefferrd == "×")
                            <!-- ×の選択状態表示 -->
                            <form action="{{ route('guest_schedules.update', ['token' => $event->token, 'guest_id' =>$guest->id, 'schedule_id'=>$schedule->id]) }}" method="post">
                                @csrf
                                {!! Form::hidden('preferred', "なし") !!}
                                <div class="mt-4 text-center">
                                    {!! Form::submit('×', ['class' => 'btn btn-primary btn-lg']) !!}
                                </div>
                            {!! Form::close() !!}
                        @else
                            <!-- ×の非選択状態表示 -->
                            <form action="{{ route('guest_schedules.update', ['token' => $event->token, 'guest_id' =>$guest->id, 'schedule_id'=>$schedule->id]) }}" method="post">
                                @csrf
                                {!! Form::hidden('preferred', "×") !!}
                                <div class="mt-4 text-center">
                                    {!! Form::submit('×', ['class' => 'btn btn-secondary btn-lg']) !!}
                                </div>
                            {!! Form::close() !!}
                        @endif
                        @if($prefferrd == "△")
                            <!-- △の選択状態表示 -->
                            <form action="{{ route('guest_schedules.update', ['token' => $event->token, 'guest_id' =>$guest->id, 'schedule_id'=>$schedule->id]) }}" method="post">
                                @csrf
                                {!! Form::hidden('preferred', "なし") !!}
                                <div class="mt-4 text-center">
                                    {!! Form::submit('△', ['class' => 'btn btn-warning btn-lg']) !!}
                                </div>
                            {!! Form::close() !!}
                        @else
                            <!-- △の非選択状態表示 -->
                            <form action="{{ route('guest_schedules.update', ['token' => $event->token, 'guest_id' =>$guest->id, 'schedule_id'=>$schedule->id]) }}" method="post">
                                @csrf
                                {!! Form::hidden('preferred', "△") !!}
                                <div class="mt-4 text-center">
                                    {!! Form::submit('△', ['class' => 'btn btn-secondary btn-lg']) !!}
                                </div>
                            {!! Form::close() !!}
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="row justify-content-center mt-4">
            <div class="col-6">
                {!! Form::model($guest, ['route' => ['guests.update', $guest->id], 'method' => 'put']) !!}
                    @csrf
                    <div class="form-group">
                        {!! Form::label('comment', 'コメント:') !!}
                        {!! Form::text('comment', null, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="mt-4 text-center">
                        {!! Form::submit('編集完了', ['class' => 'btn btn-success btn-lg w-50']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection