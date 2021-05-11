@extends('admin.layout.master')
@section('title','Ranz | Profile Setting')
@push('plugin-styles')
@endpush

@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @if(session('updated'))
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{session('updated')}}
          </div>
        @endif
        <h2 class="card-title">Profile Setting</h2>
        <form action="{{route('admin.update_profile')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
              <label for="name" class="col-form-label ml-3">{{ __('Name') }}</label>

              <div class="col-md-12">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->name}}" required autocomplete="name" autofocus>

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="name" class="col-form-label ml-3">{{ __('Email') }}</label>

              <div class="col-md-12">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="name" class="col-form-label ml-3">{{ __('Profile Picture') }}</label>

              <div class="col-md-12">
                  <input id="profile_pic" type="file" class="form-control @error('profile_pic') is-invalid @enderror" name="profile_pic">
                  @error('profile_pic')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>
        </div>
        <div class="row">
          <div class="form-group ml-4 mt-2">
            <button class="btn btn-primary submit-btn btn-block">Update</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush