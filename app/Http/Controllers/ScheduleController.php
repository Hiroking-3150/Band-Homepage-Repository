<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // public function index()
    // {
    //     $schedules = Schedule::all();

    //     // $events = $schedules->map(function ($schedule) {
    //     $events = $schedules->filter(function ($schedule) {
    //         return !empty($schedule->event_title);
    //     })->map(function ($schedule) {    
    //         return [
    //             'id' => $schedule->id,
    //             'title' => $schedule->event_title,
    //             'start' => \Carbon\Carbon::parse($schedule->event_datetime)->toIso8601String(),
    //             'event_location' => $schedule->event_location,
    //             'event_detail'   => $schedule->event_detail,
    //         ];
    //     });
    //     // dd($events);
    //     return view('schedules.calendar', compact('events'));
    // }

    public function index()
    {
        $schedules = Schedule::all();

        $events = $schedules->filter(function ($schedule) {
            return !empty($schedule->event_title);
        })->map(function ($schedule) {
            return [
                'id' => $schedule->id,
                'title' => $schedule->event_title,
                'start' => \Carbon\Carbon::parse($schedule->event_datetime)->toIso8601String(),
            ];
        });

        return view('schedules.calendar', compact('events'));
    }

    public function create()
    {
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_title' => 'required|string|max:255',
            'event_datetime' => 'required|date',
            'event_detail' => 'nullable|string',
        ]);

        $event_datetime = $request->event_datetime . ' 00:00:00';

        $event_location = $request->event_location ?? '不要';

        Schedule::create([
            'event_title'    => $request->event_title,
            'event_datetime' => $event_datetime,
            'event_location' => $event_location, 
            'event_detail'   => $request->event_detail,
        ]);

        return redirect()->route('dashboard')->with('success', '予定が追加されました！');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        \Log::info('更新リクエストが送信されました', ['request_data' => $request->all()]);

        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_detail' => 'nullable|string',
        ]);

        $event_datetime = $request->event_date ? $request->event_date . ' 00:00:00' : now()->toDateTimeString();
        // $schedule->update($request->all());
        // $schedule = Schedule::findOrFail($id);
            $schedule->update([
            'event_title' => $request->title,
            'event_datetime' => $event_datetime,
            'event_detail' => $request->event_detail,
         ]);

         \Log::info('更新後のデータ', ['updated_schedule' => $schedule]);

         \Log::info('schedule id', ['id' => $schedule->id]); 
         return redirect()->route('schedules.show', ['id' => $schedule->id])
         ->with('success', '予定が更新されました！');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', '予定を削除しました！');
    }

    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);

        return view('schedules.show', compact('schedule'));
    }
}
