@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
 
        <div class="col-md-12 bg-white rounded ">
          <div class="row">

            <div class="col-md-3 py-2 ">
              <div class="card border-success text-center">

                <h5 class="card-header"><strong>All Customer Details</strong></h5>
                <div class="card-body">
                  <h5 class="card-title">Total Customer</h5>
                  <h2>{{ $tatal_customer }}</h2>
                </div>
                <div class="card-footer text-muted">
                  <a href="{{ url('/customer/view')}}" class="btn btn-primary">View Details</a>

                </div>
              </div>
            </div>
            <div class="col-md-6 py-2">
              <div class="card border-success text-center">
                <h5 class="card-header"><strong>Book Details</strong></h5>
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title">Book Sold</h5>
                      <h2>{{ $total_book }}</h2>

                    </div>

                    <div class="col">

                      <h5 class="card-title">Book Remaining</h5>
                      <h2>
                          @if ($book_now->now_total=='')
                            0
                        @else
                        {{ $book_now->now_total }}
                          @endif       
                      </h2>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-muted">
                  <a href="{{ url('/books')}}" class="btn btn-primary">View Details</a>

                </div>
              </div>
            </div>
            <div class="col-md-3 py-2">
              <div class="card border-success text-center">
                <h5 class="card-header"><strong>Cost Details</strong></h5>
                <div class="card-body">
                  <h5 class="card-title">Total Cost</h5>
                  <h2>{{ $total_cost }} TK</h2>
                </div>
                <div class="card-footer text-muted">
                  <a href="{{ url('/cost')}}" class="btn btn-primary">View Details</a>

                </div>
              </div>
            </div>
            <div class="col-md-12 py-2 m-auto">
              <div class="card border-success   text-center">
                <h5 class="card-header"><strong>Cash Details</strong> </h5>
                <div class="card-body">

                  <div class="row">
                    <div class="col">

                      <h5 class="card-title"><strong>Total Customer Cash</strong></h5>
                      <div class="col-md-12 bg-white rounded">
                        <table class="table table-bordered " >
                          <thead class="thead">
                            <tr>
                              <th scope="col">Total Amount</th>
                              <td>{{ $total_amount1 }}</td>
                            </tr>
                            <tr>
                              <th scope="col">Total Payment By Customer</th>
                              <td>{{ $total_payment }}</td>
                            </tr>
                            <tr>
                              <th scope="col">Total Due By Customer</th>
                              <td>{{ $total_due }}</td>
                            </tr>

                      </thead>
                    </table>

                  </div>

                    </div>

                    <div class="col">

                      <h5 class="card-title"><strong>Total  Cash</strong></h5>
                      <div class="col-md-12 bg-white rounded">
                        <table class="table table-bordered " >
                          <thead class="thead">
                            <tr>
                              <th scope="col">Total Amount</th>
                              <td>{{ $total_amount }}</td>
                            </tr>
                            <tr>
                              <th scope="col">Total Deposited</th>
                              <td>{{ $total_diposit }}</td>
                            </tr>
                            <tr>
                              <th scope="col">Costing</th>
                              <td>{{ $cost_amount }}</td>
                            </tr>
                            {{-- <tr>
                            <th scope="col">Total Due</th>
                            <td>{{ $total_due }}</td>
                          </tr> --}}
                          <th scope="col">Cash in Hand</th>
                          <td>{{ $due_amount }}</td>
                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                        </tr>
                      </tbody>
                    </table>

                  </div>

                    </div>
                  </div>
                </div>




                <div class="card-footer text-muted">
                  <a href="{{ url('/cash')}}" class="btn btn-primary">View Details</a>

                </div>
              </div>
              </div>
            </div>




        </div>




        </div>

        </div>
      </div>
</div>
@endsection
