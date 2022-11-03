<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;  //ここを追加
use App\Schedule;  //ここを追加
use Illuminate\Support\Facades\DB;  //ここを追加

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //イベント一覧は不要なためなし
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
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
            'name'       => 'required',
            'schedule' => 'required',
        ]);
        
        DB::beginTransaction();
        try {
            //トークン生成
            $token = uniqid('', true); //ランダム文字列作成
            $hased_token = hash('sha256', $token); //sha256化
            
            // eventsテーブルにデータを格納
            $event = new Event($request->get('event',[
                'name' => $request->name,
                'caption' => $request->caption,
                'token' => $hased_token,
            ]));
            
            $event->save();
            
            //スケジュールDBへの保存ここから
            // eventのidを $eventId とする
            $eventId = $event->id;
            
            //スケジュールのデータを改行で分割・配列化
            $scheduleSplit = str_replace(["\r\n", "\r", "\n"], "\n", $request->schedule); //改行の特殊文字をすべてのパターンに対応できるように統一
            $scheduleSplit = explode("\n", $scheduleSplit); //配列に変換
            $scheduleSplit = array_filter($scheduleSplit, "strlen"); //空白の配列を削除
            $scheduleSplit = array_values($scheduleSplit); //連番に振り直す
            
            //schedulesテーブルにデータを格納
            foreach ($scheduleSplit as $scheduleDate) {
                $schedule = new Schedule;
                $schedule->event_id = $eventId;
                $schedule->schedule = $scheduleDate;
                $schedule->save();
            }
            //スケジュールDBへの保存ここまで
            
        }catch(Exception $e){
            DB::rollback();
            return back()->withInput();
        }
        DB::commit();
        return redirect()->route('events.complete', ['id' => $eventId]);
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
    
    public function complete($id)
    {
        // idの値でイベントを検索して取得
        $event = Event::findOrFail($id);
        
        // 親に紐づいたscheduleのテーブルを取得
        //$schedules= Event::find($id)->schedules;
        
         // 完了画面でそれを表示
        return view('events.complete', [
            'event' => $event,
            //compact('schedules'),
        ]);
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
