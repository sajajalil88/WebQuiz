<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Ticket; 


class EventController extends Controller
{
    public function reserve(Request $request)
{
    // $eventId = $request->event_id;
    // $event = Events::find($eventId);

    // if (!$event) {
    //     return redirect()->route('events.index')->with('error', 'Event not found.');
    // }

    // if ($event->available_tickets <= 0) {
    //     return redirect()->route('events.index')->with('error', 'No more tickets available for this event.');
    // }

    // try {
    //     $ticket = new Ticket();
    //     $ticket->event_id = $eventId;
    //     $ticket->user_id = Auth::id();
    //     $ticket->ticket_code = 'TICKET_' . str_random(8); 

    //     Auth::user()->tickets()->save($ticket);
    //     $event->available_tickets -= 1;
    //     $event->save();

    //     return view('pages.events.Reservation', ['ticket' => $ticket]);

    // } catch (\Exception $e) {
    //     return redirect()->route('events.index')->with('error', 'Error: ' . $e->getMessage());
    // }
    return "hii";
}


public function index()
{
    $events = Events::all(); 

    foreach ($events as $event) {
        $event->start_date_time = Carbon::parse($event->start_date_time);
        $event->end_date_time = Carbon::parse($event->end_date_time);
    }

    return view('pages.events.List', ['events' => $events]);
}

public function show($id)
{
    $event = Events::find($id);

    if (!$event) {
        return redirect()->route('events.index')->with('error', 'Event not found.');
    }

    return view('pages.events.Show', ['event' => $event]);
}

    public function create()
    {
        return view('pages.events.Add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'description' => 'nullable|string|max:500',
            'start_date_time' => 'required|date',
            'end_date_time' => 'required|date|after:start_date_time',
            'available_tickets' => 'required|integer|min:0',
        ]);

        try {
            $event = new Events();
            $event->name = $request->name;
            $event->description = $request->description;
            $event->start_date_time = $request->start_date_time;
            $event->end_date_time = $request->end_date_time;
            $event->available_tickets = $request->available_tickets;

            $event->save();

        } catch (\Exception $e) {
            dd($e->getMessage()); // Debugging
            return redirect()->back()->with('error', 'Error saving event. Please try again.');
        }

        return redirect()->route('events.index')->with('success', 'Event added successfully.');
    }

    public function edit($id)
    {
        $event = Events::find($id);

        return view('pages.events.Add')->with('object', $event);
    }

    public function update($id, Request $request)
{
    $event = Events::find($id);

    if (!$event) {
        return redirect()->route('events.index')->with('error', 'Event not found.');
    }

    $request->validate([
        'name' => 'required|string|min:5|max:255',
        'description' => 'nullable|string|max:500',
        'start_date_time' => 'required|date',
        'end_date_time' => 'required|date|after:start_date_time',
        'available_tickets' => 'required|integer|min:0',
    ]);

    try {
        $event->name = $request->name;
        $event->description = $request->description;
        $event->start_date_time = $request->start_date_time;
        $event->end_date_time = $request->end_date_time;
        $event->available_tickets = $request->available_tickets;

        $event->save();

    } catch (\Exception $e) {
        dd($e->getMessage()); // Debugging
        return redirect()->back()->with('error', 'Error updating event. Please try again.');
    }

    return redirect()->route('events.index')->with('success', 'Event updated successfully.');
}

    public function destroy($id)
    {
        $event = Events::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event not found.');
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

}
