@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
        <div class="p-2  col-md-12 m-auto rounded text-center ">
          <h2 >Customer Personal Inforation</h2>

        </div>
        <div class="col-md-5 bg-white rounded">
          <div class="row">
            <div class="col-md-6 p-3">
                <h3>{{ $customerInfo->name }}</h3>
            </div>
            <div class="col-md-6 text-right p-2">
                <img class="" src="{{ asset('photo/customer/') }}\{{ $customerInfo->photo }}" alt="User Image" width="100">
            </div>
          </div>
          <table class="table table-bordered my-2">

            <tbody >
               <tr>
                <td>Book Quantity</td>
                <td class="text-right">{{ $customerInfo->quantity }}</td>
               </tr>
               <tr>
                <td>Sales Quantity</td>

                <td class="text-right">{{ $customerInfo->sale }}</td>
               </tr>
               <tr>
                <td>Book Price</td>
                <td class="text-right">{{ $customerInfo->rate }}</td>
               </tr>
               <tr>
                 <td>Discount</td>
                 <td class="text-right">{{ $customerInfo->discount }}</td>
               </tr>
               <tr>
                <td>Total Amount</td>
                <td class="text-right">{{ $customerInfo->total }}</td>
               </tr>
               <tr>
                 <td>Total Payment</td>
                 <td class="text-right">{{ $customerInfo->payment }}</td>
               </tr>
               <tr>
                 <td>Total Due</td>
                 <td class="text-right">{{ $customerInfo->due }}</td>
               </tr>
               <tr>
                 <td>Mobile NO</td>
                  <td class="text-right">{{ $customerInfo->mobile }}</td>
               </tr>
               <tr>
                 <td>Address</td>
                 <td class="text-right">{{ $customerInfo->address }}</td>
               </tr>
            </tbody>
          </table>
          <div class="row">
            <div class="col-md-4 p-2">
                <a href="{{ url('customer/sale') }}\{{$customerInfo->id}}" class="btn btn-primary offset-3">Details</a>
            </div><div class="col-md-4 p-2">
                <a href="{{ url('customer/info/pdf') }}\{{$customerInfo->id}}" class="btn btn-danger offset-3">Download PDF</a>
            </div>
            <div class="col-md-4 text-right p-2">
              <div class="text-center">
                <a href="{{ url('customer/view') }}" class="btn btn-success">Back</a>
              </div>
            </div>
          </div>

        </div>
      </div>
</div>
@endsection
