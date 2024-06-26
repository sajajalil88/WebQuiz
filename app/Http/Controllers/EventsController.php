<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Events::all();

        foreach ($events as $event) {
            $event->start_date_time = Carbon::parse($event->start_date_time);
            $event->end_date_time = Carbon::parse($event->end_date_time);
        }

        return view('pages.events.List', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.events.Add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'nullable|string|max:500',
            'date_time' => 'required|date',
            'location' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        try {
            $event = new Events();
            $event->title = $request->title;
            $event->description = $request->description;
            $event->date_time = $request->date_time;
            $event->location = $request->location;

                // Handle file upload
            $filename = time() . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/myImages', $filename); // Store in 'storage/app/public/myImages'
            $event->image = 'storage/myImages/' . $filename; // Adjust path
            $event->save();

        } catch (\Exception $e) {
            dd($e->getMessage()); // Debugging
            return redirect()->back()->with('error', 'Error saving event. Please try again.');
        }

        return redirect()->route('event.index')->with('success', 'Event added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Events::find($id);

        return view('pages.events.Add')->with('object', $event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Events::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event not found.');
        }

        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'nullable|string|max:500',
            'date_time' => 'required|date',
            'location' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        try {
            $event->name = $request->name;
            $event->description = $request->description;
            $event->date_time = $request->start_date_time;
            $event->location = $request->location;
            $filename = time() . "-" . $request->file('image')->getClientOriginalName();
            $request->file('img')->storeAs('public/myImages', $filename); // Store in 'storage/app/public/myImages'
            $obj->image = 'storage/myImages/' . $filename; // Adjust path

            $event->save();

        } catch (\Exception $e) {
            dd($e->getMessage()); // Debugging
            return redirect()->back()->with('error', 'Error updating event. Please try again.');
        }

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Events::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event not found.');
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    public function reserve(Request $request)
    {
        return "reserve function";
         $eventId = $request->event_id;
         $event = Events::find($eventId);

         if (!$event) {
             return redirect()->route('event.index')->with('error', 'Event not found.');
         }

         if ($event->available_tickets <= 0) {
             return redirect()->route('event.index')->with('error', 'No more tickets available for this event.');
         }

         try {
             $ticket = new Ticket();
             $ticket->event_id = $eventId;
             $ticket->user_id = Auth::id();
             $ticket->ticket_code = 'TICKET_' . str_random(8);

             Auth::user()->tickets()->save($ticket);
             $event->available_tickets -= 1;
             $event->save();

             return view('pages.events.Reservation', ['ticket' => $ticket]);

         } catch (\Exception $e) {
             return redirect()->route('event.index')->with('error', 'Error: ' . $e->getMessage());
         }
    }

}
