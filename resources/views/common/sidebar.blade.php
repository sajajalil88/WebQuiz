<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                @if(Auth::check() && Auth::user()->getRoles->where('key', env('ADMIN'))->first() != null)
                
                @endif

                {{-- <li>
                    <a href="{{route('doctor.index')}}"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                </li> --}}
                <li>
                    <a href="{{route('event.index')}}"><i class="fa fa-user-md"></i> <span>Events</span></a>
                </li>


                <li>
                    <a href="{{route('ticket.index')}}"><i class="fa fa-user-md"></i> <span>Ticket</span></a>
                </li>
                @if(Auth::check() && Auth::user()->getRoles->where('key', env('USER'))->first() != null)

                <li>
                    <a href="{{route('ticket.myTicket')}}"><i class="fa fa-user-md"></i> <span>My Tickets</span></a>
                </li>
                @endif

                <li>
                    <a href="{{route('ticket.search')}}"><i class="fa fa-user-md"></i> <span>Search Tickets</span></a>
                </li>


                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
