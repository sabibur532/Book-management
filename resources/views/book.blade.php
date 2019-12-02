@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
        <div class="p-2 bg-white col-md-12 m-auto rounded text-center">
          <div class="row">
            <div class="col-md-8">
               <h2 >Book List</h2>
            </div>
            @if (Auth::user()->role==1||Auth::user()->role==2)
            <div class="col-md-4">
               <a href="{{ url('book/add') }} " class="btn btn-primary p-2 float-right">Add Book</a>
            </div>
            @endif
          </div>

        </div>
        <div class="col-md-12 bg-white rounded">
          <table class="table table-bordered" >
            <thead class="thead" >
              <tr>
                <th scope="col">SI</th>
                <th scope="col">Date</th>
                <th scope="col">Total Book</th>
                <th scope="col">Sale</th>
                <th scope="col">Coustomer Id</th>
                <th scope="col">Now Total Book</th>
                <th scope="col" >Book Add </th>
                <th scope="col" >Added By </th>
              </tr>
            </thead>
            <tbody >

              @foreach ($books as $book)

               <tr>
                 <th scope="row">{{ $loop->index+1 }}</th>
                 <td>{{ $book->created_at->format('d-m-Y') }}</td>
                 <td>{{ $book->total }}</td>
                 <td> @if ($book->sale==0)
                  @else
                    {{ $book->sale }}
                  @endif</td>
                 <td> @if ($book->customer_id==0)
                  @else
                    {{ $book->customer_id }}
                  @endif</td>

                 <td>{{ $book->now_total }}</td>
                 <td>{{ $book->add_book }}</td>
                 <td>{{ $book->added_by }}</td>

               </tr>
             @endforeach
             <tr>
               <td colspan="5"></td>
               <td><strong>Total Book Added</strong> </td>
               <td colspan="5"><strong>{{ $a }}</strong></td>

             </tr>
            </tbody>
          </table>

        </div>
          <div class="m-auto">
            {{ $books->links() }}
          </div>
          <div class="text-center">
            
          </div>
      </div>
</div>
@endsection
