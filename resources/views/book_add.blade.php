@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
  <div class="p-2 bg-white col-md-7 m-auto rounded text-center">
    <h2 >Add Book </h2>
    @if (session('status'))
       <div class="alert alert-success">
         {{ session('status') }}
       </div>
     @endif
  </div>

        <div class="col-md-7 bg-white p-5 rounded">

          <form  action="{{ url('/book/add/insert') }}" method="post">
            @csrf
            <div class="form-group row">
              <label class="col-sm-4 col-form-label"><strong>Book Amount</strong></label>
              <div class="col-sm-8">
                <input type="number"  name="add_book" class="form-control" value="">
              </div>
              
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label"><strong>Added by</strong></label>
              <div class="col-sm-8">
                <input type="text"  name="added_by" class="form-control" value="">
              </div>
              
            </div>

            <div class="p-3 offset-5">
              <button type="submit" name="" class="btn btn-primary">Submit</button>
            </div>

          </form>

        </div>
    </div>
</div>
@endsection
