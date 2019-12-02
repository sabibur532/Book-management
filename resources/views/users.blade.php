@extends('layouts.admin')

@section('content')
  <div class="col-md-8 m-auto">
    <div class="row justify-content-center">
          <div class="p-2 bg-white col-md-12 m-auto rounded text-center">
            <h2 >All Users Details</h2>

          </div>
          <div class="col-md-12 bg-white rounded">
            <table class="table table-bordered">
      <thead class="thead">
        <tr>
          <th scope="col">SI</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Image</th>
          <th scope="col">Register At</th>
          @if (Auth::user()->role==1)

          <th scope="col">Action</th>
        @endif

        </tr>
      </thead>
      <tbody>

        @foreach ($users as $user)

        <tr>
          <td>{{ $loop->index+1 }}</td>
         <td >{{ $user->name }}</td>
         <td>{{ $user->email }} </td>


         <td>
           @if ($user->role==1)
             {{ 'Admin' }}
           @elseif ($user->role==2)
             {{ 'Modarator' }}
           @else
             {{ 'Member' }}
           @endif

        </td>
        <td><img class="" src="{{ asset('photo/user/') }}\{{$user->photo }}" alt="User Image" width="100"></td>
       <td >{{ $user->created_at->format('d-m-Y') }}</td>
       @if (Auth::user()->role==1)
       <td >
         <a href="{{ url('/user/detele/') }}/{{ $user->id }}" class="btn btn-danger btn-sm">Delete</a>
       </td>
      @endif
     @endforeach
       </tr>
      </tbody>
    </table>
      <div class="text-center mb-2">
        <a href="{{ url('user/register') }}" class="btn btn-primary">Add User</a>
      </div>
          </div>
        </div>
  </div>

@endsection
