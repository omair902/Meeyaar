@extends('admin.layout.master')
@section('title','Ranz | Password Setting')
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
        <h2 class="card-title">Password Setting</h2>
        <form action="{{route('admin.update_password')}}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
              <label for="Password" class="col-form-label ml-3">{{ __('Password') }}</label>

              <div class="col-md-12">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password" autofocus>

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="name" class="col-form-label ml-3">{{ __('Confirm Password') }}</label>

              <div class="col-md-12">
                  <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="password_confirmation" autofocus>
              </div>
            </div>
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