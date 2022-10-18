<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::latest()->paginate(5);
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
        $start_date = $form_details['start_date'];
        $end_date = $form_details['end_date'];
        $start_date_by_underscore = explode("/", $start_date);
        $end_date_by_underscore = explode("/", $end_date);
        $form_details['start_date'] = $start_date_by_underscore[2] . '-' . $start_date_by_underscore[0] . '-' . $start_date_by_underscore[1] . '';
        $form_details['end_date'] = $end_date_by_underscore[2] . '-' . $end_date_by_underscore[0] . '-' . $end_date_by_underscore[1] . '';
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
        $start_date_by_underscore = explode("-", $event->start_date);
        $end_date_by_underscore = explode("-", $event->end_date);
        $event->start_date = $start_date_by_underscore[1] . '-' . $start_date_by_underscore[2] . '-' . $start_date_by_underscore[0] . '';
        $event->end_date = $end_date_by_underscore[1] . '-' . $end_date_by_underscore[2] . '-' . $end_date_by_underscore[0] . '';

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
        $start_date = $form_details['start_date'];
        $end_date = $form_details['end_date'];
        $start_date_by_underscore = explode("/", $start_date);
        $end_date_by_underscore = explode("/", $end_date);
        $form_details['start_date'] = $start_date_by_underscore[2] . '-' . $start_date_by_underscore[0] . '-' . $start_date_by_underscore[1] . '';
        $form_details['end_date'] = $end_date_by_underscore[2] . '-' . $end_date_by_underscore[0] . '-' . $end_date_by_underscore[1] . '';
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
}
