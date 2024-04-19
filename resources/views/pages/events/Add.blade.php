@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        @if(!(isset($object)))
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Add Event</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Event Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}" required>
                                    @error('name')
                                            <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Date & Time <span class="text-danger">*</span></label>
                                    <input class="form-control" type="datetime-local" name="start_date_time" value="{{old('start_date_time')}}" required>
                                    @error('start_date_time')
                                            <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Date & Time <span class="text-danger">*</span></label>
                                    <input class="form-control" type="datetime-local" name="end_date_time" value="{{old('end_date_time')}}" required>
                                    @error('end_date_time')
                                            <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Available Tickets <span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="available_tickets" value="{{old('available_tickets')}}" required>
                                    @error('available_tickets')
                                            <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description">{{old('description')}}</textarea>
                                    @error('description')
                                            <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="m-t-20 text-center">
                                    <button class="btn btn-primary submit-btn" type="submit">Create Event</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Edit Event</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form  action="{{ route('events.update', ['event' => $object->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <input type="hidden" name="_method" value="PUT">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Event Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{ $object->name ?? old('name') }}" required>
                                    @error('name')
                                            <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Date & Time <span class="text-danger">*</span></label>
                                    <input class="form-control" type="datetime-local" name="start_date_time" value="{{ $object->start_date_time ?? old('start_date_time') }}" required>
                                    @error('start_date_time')
                                            <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Date & Time <span class="text-danger">*</span></label>
                                    <input class="form-control" type="datetime-local" name="end_date_time" value="{{ $object->end_date_time ?? old('end_date_time') }}" required>
                                    @error('end_date_time')
                                            <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Available Tickets <span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="available_tickets" value="{{ $object->available_tickets ?? old('available_tickets') }}" required>
                                    @error('available_tickets')
                                            <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description">{{ $object->description ?? old('description') }}</textarea>
                                    @error('description')
                                            <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="m-t-20 text-center">
                                    <button class="btn btn-primary submit-btn" type="submit">Update Event</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
       @endif
    </div>
@endsection
