<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('schedules.calendar');
    }

    public function create()
    {
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        dd($request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        //Schedule::create($request->all());
        Schedule::create($request->except('_token'));

        return redirect()->route('/dashboard')->with('success', '予定が追加されました！');
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
}
