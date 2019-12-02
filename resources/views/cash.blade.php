@extends('layouts.admin')

@section('content')
  <div class="row">
<div class="col-md-7 pl-5">
  <div class="row justify-content-center">
        <div class="p-2 bg-white col-md-12 m-auto rounded text-center">
          <h2 >Cash Details</h2>

        </div>
        <div class="col-md-12 bg-white rounded">
          <table class="table table-bordered ">
            <thead class="thead">
              <tr>
                <th scope="col">SI</th>
                <th scope="col">Date</th>
                <th scope="col">Pay By</th>
                <th scope="col">Amount</th>

              </tr>
            </thead>
            <tbody>

              @foreach ($cashs as $cash)

              <tr>
                <td>{{ $loop->index+1 }}</td>
               <td >{{ $cash->created_at->format('d-m-Y') }}</td>
               <td >{{$cash->by==1? 'Bank Diposit':'Cash In hand'}}</td>
               <td> {{ $cash->amount }}</td>

             @endforeach
             </tr>
             <tr>
               <td colspan="2"></td>
               <td><strong>Total</strong></td>
               <td><strong>{{ $total_diposit }}</strong></td>
             </tr>
            </tbody>
          </table>
          <div class="m-auto">
            {{ $cashs->links() }}
          </div>
             @if (Auth::user()->role==1||Auth::user()->role==2)
          <div class="text-center">
            <a href="{{ url('cash/add') }} " class="btn btn-primary p-2">Add payment</a>
          </div>
          @endif
        </div>
      </div>
</div>
<div class="col-md-4 ml-5">
  <div class="row justify-content-center">
        <div class="p-2 bg-white col-md-12 m-auto rounded text-center">
          <h2 >Cash summary</h2>

        </div>
        <div class="col-md-12 bg-white rounded">
          <table class="table table-bordered">
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
@endsection
