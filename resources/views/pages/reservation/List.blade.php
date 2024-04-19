@extends('layouts.app')
@section('content')

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title"> MY Tickets</h4>
            </div>
            @if(Auth::user()->getRoles->where('key','A')->first() != null)
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{route('ticket.create')}}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Ticket</a>
            </div>
            @endif
        </div>
        <div class="row event-grid event-container">
            @foreach($tickets as $data)
            <div class="col-md-4 col-sm-4 col-lg-3 event-card" id='row{{$data->id}}'>
                <div class="profile-widget">
                   
                    @if(Auth::user()->getRoles->where('key','A')->first() != null)
                    <div class="dropdown profile-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        
                    </div>
                    @endif
                   
                    <h4 class="event-name text-ellipsis"><a href=""> Event: {{$data->getEvent->title}}</a></h4>
                  
                    
                   
                    <div class="event-date">
                        <h4 class="event-name text-ellipsis"><a href="">Price: {{$data->price}}</a></h4>
                    </div>
                   
                
                   

                </div>


            </div>
            
            @endforeach
        </div>
    </div>
</div>

@endsection
