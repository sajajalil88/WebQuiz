@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        @if(!(isset($object)))
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Add Doctor</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="POST" action="{{ route('doctor.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Full Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}" required>
                                    @error('name')
                                            <div class="error-msg">{{ $message }}</div>
                                            @enderror
                                </div>
                            </div>
                         
                         
            
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Speciality</label>
                                            <input type="text" class="form-control" value="{{old('speciality')}}" name="speciality">
                                        </div>
                                    </div>
                            </div>
                            </div>
                         
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="mobile" value="{{old('mobile')}}">
                                    @error('mobile')
                                    <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Image <span class="text-danger">*</span></label>
                                    <div class="profile-upload">
                                        <div class="upload-img">
                                            <div class="image-area">
                                                <img data-enlargable id="logoPreview" class="img" width="200px">
                                            </div>
                                        </div>
                                        <div class="upload-input">
                                        <input type="file" name="image" class="form-control" onchange="previewFile(this, 'logoPreview')" accept="image/jpeg, image/png, image/gif, image/jpg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" type="submit">Create Doctor</button>
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
                        <h4 class="page-title">Update Doctor</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" action="{{ route('doctor.update', ['doctor' => $object->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <Label>{{$object->name}}</Label>
                                        <input class="form-control" type="text" name="name" value="{{$object->name}}" required>
                                        @error('name')
                                        <div class="error-msg">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                  
                       
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>speciality</label>
                                                <input type="text" class="form-control" value="{{$object->speciality}}" name="speciality">
                                                @error('speciality')
                                                <div class="error-msg">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mobile <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="mobile" value="{{$object->mobile}}">
                                        @error('mobile')
                                        <div class="error-msg">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                              
                                <div class="col-sm-6">
                                    <div class="m-t-20 text-center">
                                        <button class="btn btn-primary submit-btn" type="submit">Save Doctor</button>
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
