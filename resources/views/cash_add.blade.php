@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
  <div class="p-2 bg-white col-md-7 m-auto rounded text-center">
    <h2 >Add Cash Payment Method </h2>
  </div>

        <div class="col-md-7 bg-white p-5 rounded">

          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          <form  action="{{ url('/cash/add/insert') }}" method="post">
            @csrf
            <div class="form-group row">
              <label class="col-sm-4 col-form-label"><strong>Cash Amount</strong></label>
              <div class="col-sm-8">
                <input type="number"  name="amount" class="form-control" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label"><strong>Pay By</strong></label>
              <div class="col-sm-8">
                <select class="form-control" name="by">
                  <option selected>--Select--</option>
                  <option value="1">Bank Diposit</option>
                  <option value="2">Hand Payment</option>
                  <option value="3">Hand Payment by Customer</option>
                </select>
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
