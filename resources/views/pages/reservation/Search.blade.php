@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Search Ticket</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="POST" action="{{ route('ticket.search') }}">
                        @csrf 

                        <div class="form-group">
                            <label>Enter Ticket Serial Number</label>
                            <input class="form-control" name="search">
                        </div>
                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Search Ticket</button>
                        </div>
                    </form>

                    @if(isset($tickets))
                        <div class="m-t-20">
                            <h4>Search Results:</h4>
                            <ul>
                                <div class="row event-grid event-container">
                                    @foreach($tickets as $data)
                                    <div class="col-md-4 col-sm-4 col-lg-3 event-card" id='row{{$data->id}}'>
                                        <div class="profile-widget">
                                           
                                            @if(Auth::user()->getRoles->where('key','A')->first() != null)
                                            <div class="dropdown profile-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                
                                            </div>
                                            @endif
                                           
                                            <h4 class="event-name text-ellipsis"><a href="">{{$data->getEvent->title}}</a></h4>
                                          
                                            
                                           
                                            <div class="event-date">
                                                <h4 class="event-name text-ellipsis"><a href="">Price: {{$data->price}}</a></h4>
                                            </div>
                                            <div class="event-date">
                                                <h4 class="event-name text-ellipsis"><a href=""> Status: {{$data->status}}</a></h4>
                                            </div>
                                            {{-- problem here --}}
                                            @if(Auth::user() && Auth::user()->getRoles->where('key', 'U'))->first() != null)
                                            @if($data->status == "Active")
                                            <div class="event-action">
                                                <form method="POST" action="{{ route('ticket.reserve') }}">
                                                    @csrf
                                                    <input type="hidden" name="ticket_id" value="{{ $data->id }}">
                                                    <button type="submit" class="btn btn-success btn-rounded">Reserve</button>
                                                </form>
                                            </div>
                                            @endif
                                            @endif
                        
                                        </div>
                                        <!-- Inside your event card div -->
                        
                        
                                    </div>
                                    
                                    @endforeach
                                </div>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
