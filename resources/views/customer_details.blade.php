@extends('layouts.admin')

@section('content')
<div class="mx-2">
  <div class="row justify-content-center">
        <div class="p-2 bg-white col-md-12 m-auto rounded text-center">
            <div class="row">
              <div class="col-md-10 m-auto"><h2 >Customer Details</h2></div>
              <div class="col-md-2 m-auto">
                <a href="{{ url('/customer/pdf')}}" class="btn btn-success">Convart PDF</a>
              </div>
            </div>
          <div class="">
            <ul class="nav nav-tabs justify-content-center">
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/customer/view') }}">All Customer details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/customer/paidview') }}">Paid Customer Details </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/customer/dueview') }}">Deu Customer Details</a>
              </li>

            </ul>
          </div>

        </div>
        <div class="col-md-12 bg-white rounded">
          <table class="table table-bordered " >
            <thead class="thead">
              <tr>
                <th scope="col">SI</th>
                <th scope="col">Date</th>
                <th scope="col">Customer Id</th>
                <th scope="col">Name</th>
                <th scope="col">Mobile</th>
                <th scope="col">Quantity</th>
                <th scope="col">Rate</th>
                <th scope="col">Discount</th>
                <th scope="col">Total</th>
                <th scope="col">Payment</th>
                <th scope="col">Due</th>
                {{-- <th scope="col">Address</th>
                <th scope="col">Comment</th> --}}
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($customers as $customer)

               <tr>
                 <th scope="row">{{ $loop->index+1 }}</th>
                 <td>{{ $customer->created_at->format('d-m-y') }}</td>
                 <td>{{ $customer->customer_code }}</td>
                 <td>{{ $customer->name }}</td>
                 <td>{{ $customer->mobile }}</td>
                 <td>{{ $customer->quantity }}</td>
                 <td>{{ $customer->rate }}</td>
                 <td>{{ $customer->discount }}</td>
                 <td>{{ $customer->total }}</td>
                 <td>{{ $customer->payment }}</td>
                 <td>{{ $customer->due }}</td>
                 {{-- <td>{{ $customer->address }}</td>
                 <td>{{ $customer->comment }}</td> --}}
                 <td>
                   <a href="{{ url('customer/info') }}/{{ $customer->id }}" class="btn btn-primary btn-sm ">View</a>
                     @if (Auth::user()->role==1||Auth::user()->role==2)
                   <a href="{{ url('/customer/edit') }}/{{ $customer->id }}" class="btn btn-warning btn-sm ">Add more..</a>
                    @endif
                 </td>
               </tr>
             @endforeach
             <tr >
               <td colspan="4"></td>
               <td><strong>Total Book Sold</strong> </td>
               <td>{{ $total_book }}</td>
               <td colspan="2"><strong>Total Amount</strong> </td>
               <td>{{ $total_amount }}</td>
               <td>{{ $total_payment }}</td>
               <td>{{ $total_due }}</td>
               <td colspan="3"></td>
             </tr>
            </tbody>



          </table>
        </div>
        <div class="m-auto">
          {{ $customers->links() }}
        </div>
      </div>
</div>
@endsection
