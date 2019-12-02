<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;
use App\Cash;
use App\Cost;
use App\Book;
use Carbon\Carbon;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

      $total_amount = Customer::sum('payment');
      $total_diposit = Cash::sum('amount');
      $total_due = $total_amount-$total_diposit;
      $cost_amount =  Cost::sum('amount');
      $due_amount = $total_due - Cost::sum('amount');

      $tatal_customer = Customer::count();
      $total_book = Customer::sum('quantity');
      $total_cost = Cost::sum('amount');
      $book_now =  Book::latest()->first();

      $total_amount1 = Customer::sum('total');
      $total_payment = Customer::sum('payment');
      $total_due = Customer::sum('due');


      return view('home', compact('total_amount','total_diposit','total_due','cost_amount','due_amount','tatal_customer','total_book','total_cost','book_now','total_amount1','total_payment','total_due'));

    }

    function users()
    {
    $users = User::all();
    return view('users', compact('users'));
    }

    function userregister()
    {
    return view('user_register');
    }


    function userregisterinsert(Request $request)
    {
      $request->validate([
          'name' => 'required',
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:6'],
          'photo' => 'required',
          'role' => 'required',
      ]);

      $lastid = User::insertGetId([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        'created_at'=>Carbon::now(),
      ]);
      if ($request->hasFile('photo')) {
        $mainimage = $request->photo;
        $imagename = $lastid.'.'.$mainimage->getClientOriginalExtension();
        Image::make($mainimage)->resize(512,512)->save(base_path('public/photo/user/'.$imagename));
        User::find($lastid)->update([
            'photo' =>$imagename,
        ]);

        return redirect('/users');


      }
    }
    
    function delete($user_id)
    {
      User::find($user_id)->delete();
      return back();
    }
}
