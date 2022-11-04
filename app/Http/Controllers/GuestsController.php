<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;  //ここを追加
use App\Schedule;  //ここを追加
use App\Guest;  //ここを追加
use App\GuestSchedules;  //ここを追加
use Illuminate\Support\Facades\DB;  //ここを追加

class GuestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required',
        ]);
        
        //新規ゲスト作成
        $guest = new Guest;
        $guest->event_id = $request->event_id;
        $guest->name = $request->name;
        $guest->comment = '';
        $guest->save();
        
        //イベントからトークンを調べる
        //idの値でtokenを検索
        $event = Event::where('id', $request->event_id)->first();
        $token = $event->token;
        
        //ゲストスケジュール作成に遷移
        return redirect()->route('guest_schedules.store', ['token' => $token , 'guest_id' => $guest->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // idの値でゲストを検索して取得
        $guest = Guest::findOrFail($id);
        // コメントを更新
        $guest->comment = $request->comment;
        $guest->save();
        
        //イベントIDからトークン検索
        //idの値でtokenを検索
        $event = Event::where('id', $guest->event_id)->first();
        $token = $event->token;
        
        // 表示ページへリダイレクトさせる
        return redirect()->route('events.show', ['token' => $event->token]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
