@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}

                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/user/register/insert') }}" enctype="multipart/form-data">
                        @csrf


                                    @if ($errors->any())
                                          <div class="alert alert-danger">
                                              <ul>
                                                  @foreach ($errors->all() as $error)
                                                      <li>{{ $error }}</li>
                                                  @endforeach
                                              </ul>
                                          </div>
                                      @endif

                                      <div class="form-group row">
                                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                          <div class="col-md-6">
                                              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                          <div class="col-md-6">
                                              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  autocomplete="email">
                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                          <div class="col-md-6">
                                              <input id="password" type="password" class="form-control" name="password"  >

                                          </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                                          <div class="col-md-6">
                                              <input  type="file" class="form-control" name="photo"  >

                                          </div>
                                      </div>

                                    <div class="form-group row">
                                        <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                        <div class="col-md-6">
                                          <select class="form-control"  name="role">
                                            <option selected>--Select Role--</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Modarator</option>
                                            <option value="3">Member</option>
                                          </select>
                                        </div>
                                    </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
