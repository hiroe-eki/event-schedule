<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;  //ここを追加
use App\Schedule;  //ここを追加
use App\Guest;  //ここを追加
use App\GuestSchedules;  //ここを追加
use Illuminate\Support\Facades\DB;  //ここを追加

class GuestSchedulesController extends Controller
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
    public function store(Request $request, $id)
    {
        //イベントIDを元にゲストID・スケジュールIDの呼び出し
        $schedules = Event::findOrFail($id)->schedules;
        $guests = Event::findOrFail($id)->guests;
        
        //該当IDのデータがなかったら作成、あったらそのまま表示
        $guest_schedules = GuestSchedules::firstOrCreate([
            'schedule_id' => $schedules,
            'guest_id' => $guests
        ], [
            'schedule_id'   => $schedules,
            'guest_id'   => $guests,
            'preferred'   => ''
        ]);
        
        // 更新ページへリダイレクトさせる
        return redirect()->route('guest_schedules.edit', ['id' => $id]);
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
        return view('guest_schedules.edit');
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
        //
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
