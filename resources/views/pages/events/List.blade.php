@extends('layouts.app')
@section('content')

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Events</h4>
            </div>
            @if(Auth::user()->getRoles->where('key','A')->first() != null)
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{route('event.create')}}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Event</a>
            </div>
            @endif
        </div>
        <div class="row event-grid event-container">
            @foreach($events as $data)
            <div class="col-md-4 col-sm-4 col-lg-3 event-card" id='row{{$data->id}}'>
                <div class="profile-widget">
                    <div class="event-img">
                        <a class="avatar" href=""><img alt="{{$data->name}} image" src="{{asset($data->image)}}"></a>
                    </div>
                    @if(Auth::user()->getRoles->where('key','A')->first() != null)
                    <div class="dropdown profile-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('events.edit', ['event' => $data->id]) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            <a type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_event_{{$data->id}}" data-event-id="{{$data->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                    </div>
                    @endif
                    <h4 class="event-name text-ellipsis"><a href="">{{$data->name}}</a></h4>
                    <div class="event-date">
                        <i class="fa fa-calendar"></i> {{$data->start_date_time->format('d M Y')}} - {{$data->end_date_time->format('d M Y')}}
                    </div>
                    <div class="event-tickets">
                        <i class="fa fa-ticket"></i> Available Tickets: {{$data->available_tickets}}
                    </div>
                    {{-- problem here --}}
                    @if(Auth::user() && Auth::user()->getRoles->where('key', 'U'))->first() != null)
                    <div class="event-action">
                        <form method="POST" action="{{ route('events.reserve') }}">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $data->id }}">
                            <button type="submit" class="btn btn-success btn-rounded">Reserve</button>
                        </form>
                    </div>
                    @endif

                </div>
                <!-- Inside your event card div -->


            </div>
            <div id="delete_event_{{$data->id}}" class="modal fade delete-modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="assets/img/sent.png" alt="" width="50" height="46">
                            <h3>Are you sure want to delete this Event?</h3>
                            <div class="m-t-20">
                                <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                <button type="submit" onclick="DeleteAjaxCall('{{$data->id}}', '{{ route('events.destroy', ['event' => $data->id]) }}')" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
