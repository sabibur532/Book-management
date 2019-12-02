@extends('layouts.admin')

@section('content')
  <div class="row">
<div class="col-md-6 m-auto">
  <div class="row justify-content-center">
        <div class="p-2 bg-white col-md-12 m-auto rounded text-center">
          <h2 >Cost Details</h2>

        </div>
        <div class="col-md-12 bg-white rounded">
          <table class="table table-bordered">
            <thead class="thead">
              <tr>
                <th scope="col">SI</th>
                <th scope="col">Date</th>
                <th scope="col">Cost Title</th>
                <th scope="col">Amount</th>

              </tr>
            </thead>
            <tbody>

              @foreach ($costs as $cost)

              <tr>
                <td>{{ $loop->index+1 }}</td>
               <td >{{ $cost->created_at->format('d-m-Y') }}</td>
               <td >{{ $cost->title }}</td>
               <td>{{ $cost->amount }} </td>
             @endforeach

             </tr>
             <tr>
               <td colspan="2"></td>
               <td><strong>Total</strong></td>
               <td><strong>{{ $total }}</strong></td>
             </tr>
            </tbody>
          </table>
          {{ $costs->links() }}
           @if (Auth::user()->role==1||Auth::user()->role==2)
          <div class="text-center">
            <a href="{{ url('cost/add') }} " class="btn btn-primary p-2">Add Cost</a>
          </div>
          @endif
        </div>
      </div>
</div>
</div>
@endsection
