<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('pages.ticket.List')->with('tickets', $tickets);
    }

    public function create()
    {
        $events = Events::all();
        return view('pages.ticket.Add')->with('events', $events);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_id' => 'required|exists:events,id',
            'price' => 'required|numeric|min:0',
        ]);

        $serialNumber = Str::uuid(); 

        $userId = Auth::id();

        $ticket = new Ticket();
        $ticket->user_id = $userId;
        $ticket->event_id = $validatedData['event_id'];
        $ticket->serial_number = $serialNumber;
        $ticket->price = $validatedData['price'];
        $ticket->status = 'Active';

        $ticket->save();

        return redirect()->route('ticket.index')->with('success', 'Event added successfully.');
    }
    public function reserve(Request $request)
    {
       // return "hi";
        $validatedData = $request->validate([
            'ticket_id' => 'required|exists:tickets,id', 
        ]);
    
         $userId = Auth::id();
    
         $ticket = Ticket::find($validatedData['ticket_id']);
        
        if (!$ticket) {
            return redirect()->route('ticket.index')->with('error', 'Ticket not found.');
        }
    
       
        $ticket->user_id = $userId;
        $ticket->status = 'Reserved';
        $ticket->save();
    
        return redirect()->route('ticket.myTicket')->with('success', 'Ticket reserved successfully.');
    }
    public function myTicket()
{
    $userId = Auth::id();
    
    $tickets = Ticket::where('user_id', $userId)->get();

    return view('pages.reservation.List')->with('tickets', $tickets);
}
public function search(Request $request)
{
    if ($request->isMethod('post')) {
        $validatedData = $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $tickets = Ticket::where('serial_number', 'like', '%' . $validatedData['search'] . '%')->get();

        return view('pages.reservation.Search')->with('tickets', $tickets);
    }

    return view('pages.reservation.Search');
}



}
