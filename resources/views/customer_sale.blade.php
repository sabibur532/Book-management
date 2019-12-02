@extends('layouts.admin')

@section('content')
<div class="mx-2">
  <div class="row justify-content-center">
        <div class="p-2 bg-white col-md-10 m-auto rounded text-center">
          <div class="row">
            <div class="col-md-6 p-3">
                <h3>{{ $name->name }}</h3>
            </div>
            <div class="col-md-6 text-center p-2">
                <img class="" src="{{ asset('photo/customer/') }}\{{ $name->photo }}" alt="User Image" width="100">
            </div>
          </div>


        </div>
        <div class="col-md-10 bg-white rounded">
          <table class="table table-bordered " >
            <thead class="thead">
              <tr>
                <th scope="col">SI</th>
                <th scope="col">Date</th>

                <th scope="col">Quantity</th>
                <th scope="col">Rate</th>
                <th scope="col">Discount</th>
                <th scope="col">Total</th>
                <th scope="col">Payment</th>
                <th scope="col">Due</th>
                {{-- <th scope="col">Address</th>
                <th scope="col">Comment</th> --}}

              </tr>
            </thead>
            <tbody>


                @forelse ($details as $detail)


               <tr>
                 <th scope="row">{{ $loop->index+1 }}</th>
                 <td>{{ $detail->created_at->format('d-m-y') }}</td>
                 <td>{{ $detail->quantity }}</td>
                 <td>{{ $detail->rate }}</td>
                 <td>{{ $detail->discount }}</td>
                 <td>{{ $detail->total }}</td>
                 <td>{{ $detail->payment }}</td>
                 <td>{{ $detail->due }}</td>

             @empty
               <td colspan="8" class="text-center text-danger">No data Available</td>
             @endforelse
           </tr>

            </tbody>



          </table>
          
        </div>

      </div>
</div>
@endsection
