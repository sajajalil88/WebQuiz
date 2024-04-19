@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Add Ticket</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="POST" action="{{ route('ticket.store') }}">
                        @csrf <!-- CSRF Token -->

                        <div class="form-group">
                            <label>Event</label>
                            <select class="select form-control" name="event_id">
                                <option value="">Select</option>
                                @foreach($events ?? [] as $event)
                                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                                @endforeach
                            </select>
                            @error('event_id')
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input class="form-control" name="price" value="{{ old('price') }}">
                            @error('price')
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <input class="form-control" name="status" value="{{ old('status', 'Active') }}">
                            @error('status')
                                <div class="error-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Create Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
