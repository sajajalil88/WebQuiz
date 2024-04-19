@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reservation Confirmation</div>

                <div class="card-body">
                    <p>Your ticket has been reserved successfully!</p>
                    <p>Ticket Code: {{ $ticket->ticket_code }}</p>
                    <p>Event Name: {{ $ticket->event->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
