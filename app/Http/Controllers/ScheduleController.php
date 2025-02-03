<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();

        // $events = $schedules->map(function ($schedule) {
        $events = $schedules->filter(function ($schedule) {
            return !empty($schedule->event_title);
        })->map(function ($schedule) {    
            return [
                'id' => $schedule->id,
                'title' => $schedule->event_title,
                'start' => \Carbon\Carbon::parse($schedule->event_datetime)->toIso8601String(),
                'event_location' => $schedule->event_location,
                'event_detail'   => $schedule->event_detail,
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

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $schedule->update($request->all());

        return redirect()->route('/dashboard')->with('success', '予定が更新されました！');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('/dashboard')->with('success', '予定を削除しました！');
    }

    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);

        return view('schedules.show', compact('schedule'));
    }
}
