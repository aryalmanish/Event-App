<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Auth;
use Redirect;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('start_date', 'ASC')->paginate(5);
        return view('events.index',compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required',
        ]);
        $form_details = $request->except('_token');
        Event::create($form_details);

        return redirect()->route('events.index')
            ->with('success','Event created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::where('id',$id)->first();
        if(!$event) {
            return redirect('/')->with('message', 'No Data Found.');
        }
        return view('events.show',compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = (object) Event::findOrFail($id);
        return view('events.edit',compact('event'));
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
        $form_details = $request->except('_token', '_method');
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required',
        ]);
        Event::where('id',$id)->update($form_details);
        return redirect()->route('events.index')
            ->with('success','Events updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')
            ->with('success','Events deleted successfully');
    }
    public function finished_events()
    {
        $currentdate = date('Y-m-d');
        $events = Event::orderBy('start_date', 'ASC')->where('end_date', '<' , $currentdate )->paginate(5);
        return view('events.index',compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function upcoming_events()
    {
        $currentdate = date('Y-m-d');
        $events = Event::orderBy('start_date', 'ASC')->where('start_date', '>' , $currentdate )->paginate(5);
        return view('events.index',compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function upcoming_events_within_seven_days()
    {
        $currentdate = date('Y-m-d');
        $nextweek = date("Y-m-d", strtotime("+1 week"));
        $events = Event::orderBy('start_date', 'ASC')->whereBetween('start_date', [$currentdate, $nextweek])->paginate(5);
        return view('events.index',compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function finished_events_within_seven_days()
    {
        $currentdate = date('Y-m-d');
        $lastWeek = date("Y-m-d", strtotime("-1 week"));
        $events = Event::orderBy('start_date', 'ASC')->whereBetween('end_date', [$lastWeek,$currentdate ])->paginate(5);
        return view('events.index',compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function logout()
    {   
        Auth::logout();
        return Redirect::to('login');

    }
    public function eventDelete(Request $request) 
    {
        $event = Event::findOrFail($request->id);
        $event->delete();

        return redirect()->route('events.index')
            ->with('success','Events deleted successfully');
    }

}
