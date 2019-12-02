<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Book;
use App\Cash;
use App\Cost;
use App\Sale;
use Carbon\Carbon;
use Image;
use PDF;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function view()
    {
      $customers = Customer::orderBy('id', 'desc')->paginate(10);

      $total_book = Customer::sum('quantity');
      $total_amount = Customer::sum('total');
      $total_payment = Customer::sum('payment');
      $total_due = Customer::sum('due');
      return view('customer_details', compact('customers','total_amount','total_payment','total_due','total_book'));
    }
    function paidview()
    {
      $customers = Customer::orderBy('id', 'desc')->where('due', '=', 0)->paginate(10);
      $total_book = Customer::sum('quantity');
      $total_amount = Customer::sum('total');
      $total_payment = Customer::sum('payment');
      $total_due = Customer::sum('due');
      return view('customer_details', compact('customers','total_amount','total_payment','total_due','total_book'));
    }
    function dueview()
    {
      $customers = Customer::orderBy('id', 'desc')->where('due', '>', 0)->paginate(10);
      $total_book = Customer::sum('quantity');
      $total_amount = Customer::sum('total');
      $total_payment = Customer::sum('payment');
      $total_due = Customer::sum('due');
      return view('customer_details', compact('customers','total_amount','total_payment','total_due','total_book'));
    }




    function add()
    {
      return view('customer_add');
    }


    function addinsert(Request $request)
    {
      if (Book::latest()->exists()) {
      $request->validate([
          'customer_code' => 'required|unique:customers,customer_code',
          'name' => 'required',
          'address' => 'required',
          'mobile' => 'required|unique:customers,mobile',
          // 'photo' => 'required',
          'quantity' => 'required',
          'rate' => 'required',
          'discount' => 'required',
          // 'total' => 'required',
          'payment' => 'required',
          // 'due' => 'required',
      ]);

      $total =  ($request->quantity*$request->rate)-$request->discount;
      $due = $total - $request->payment;
      $lastinsertid = Customer::insertGetId([
        'customer_code' => $request->customer_code,
        'name' => $request->name,
        'mobile' => $request->mobile,
        'quantity' => $request->quantity,
        'rate' => $request->rate,
        'discount' => $request->discount,
        'total' => $total,
        'payment' => $request->payment,
        'due' => $due ,
        'address' => $request->address,
        'comment' => $request->comment,
        'created_at'=>Carbon::now(),
      ]);

      if ($request->hasFile('photo')) {
        $mainimage = $request->photo;
        $imagename = $lastinsertid.'.'.$mainimage->getClientOriginalExtension();
        Image::make($mainimage)->resize(512,512)->save(base_path('public/photo/customer/'.$imagename));
        Customer::find($lastinsertid)->update([
            'photo' =>$imagename,
        ]);
      }

 
      Sale::insert([
        'customer_id'=>$lastinsertid,
        'quantity' => $request->quantity,
        'rate' => $request->rate,
        'discount' => $request->discount,
        'total' => $total,
        'payment' => $request->payment,
        'due' => $due ,
        'created_at'=>Carbon::now(),
      ]);



      $bookid = Book::insertGetId([
        'sale'=> $request->quantity,
        'customer_id'=> $lastinsertid,
        'created_at'=>Carbon::now(),
      ]);

      Book::where('id', $bookid)->update([
        'total'=> Book::where('id', $bookid-1)->first()->now_total,
        'now_total'=>  (Book::where('id', $bookid-1)->first()->now_total) - $request->quantity,
      ]);
      }
      else {

        return view('book_add');
      }
      //return redirect('/customer/view');

    }

    function info($customerId)
    {
      $customerInfo = Customer::where('id', $customerId)->first();
     return view('customer_info', compact('customerInfo'));
    }

    function edit($customerId)
    {
      $customerInfo = Customer::where('id', $customerId)->first();
     return view('customer_edit', compact('customerInfo'));
    }

    function editinsert(Request $request)
    {
      $request->validate([
          'quantity' => 'required',
          'discount' => 'required',
          'payment' => 'required',
      ]);

      $total =  ($request->quantity*$request->rate)-$request->discount;
      $due = $total - $request->payment;
      $last_entry = Customer::where('id', $request->id)->first()->due;
      $due1 = $last_entry- $request->payment;
       $updateId = Customer::where('id', $request->id);
       $updateId->increment('quantity', $request->quantity);
       $updateId->increment('discount', $request->discount);
       $updateId->increment('payment', $request->payment);
       $updateId->increment('total', $total);
       $updateId->increment('due', $due);
       $updateId->increment('sale', 1);


       $bookid = Book::insertGetId([
         'sale'=> $request->quantity,
         'customer_id'=> $request->id,
         'created_at'=>Carbon::now(),
       ]);
       
       if ($request->quantity == 0) {
       Sale::insert([
         'customer_id'=>$request->id,
         'quantity' => $request->quantity,
         'rate' => $request->rate,
         'discount' => $request->discount,
         'total' => $total,
         'payment' => $request->payment,
         'due' => $due1 ,
         'created_at'=>Carbon::now(),
       ]);
        
       }
       else{
        Sale::insert([
         'customer_id'=>$request->id,
         'quantity' => $request->quantity,
         'rate' => $request->rate,
         'discount' => $request->discount,
         'total' => $total,
         'payment' => $request->payment,
         'due' => Customer::where('id', $request->id)->first()->due,
         'created_at'=>Carbon::now(),
       ]);
        
       }


       Book::where('id', $bookid)->update([
         'total'=> Book::where('id', $bookid-1)->first()->now_total,
         'now_total'=>  (Book::where('id', $bookid-1)->first()->now_total) - $request->quantity,
       ]);



      return redirect('/customer/view');
    }


   function sale($id)
   {
    $details = Sale::where('customer_id', $id)->get();
    $name= Customer::where('id',$id)->first();
     return view('customer_sale',  compact('details','name'));
   }



//book
    function book()
    {
      $books = Book::orderBy('id', 'desc')->paginate(20);
      $a = Book::sum('add_book');
     return view('book', compact('books','a'));

    }
    function bookadd()
    {
     return view('book_add');
    }
    function bookaddinsert(Request $request)
    {
      if (Book::latest()->exists()) {
        $lastid = Book::latest()->first();
        Book::insert([
          'total'=> ($lastid->total)+ $request->add_book,
          'now_total'=> ($lastid->now_total)+ $request->add_book,
          'add_book'=> $request->add_book,
          'added_by'=> $request->added_by,
          'sale'=>0,
          'customer_id'=>0,
          'created_at'=>Carbon::now()

        ]);
      }
      else {
        Book::insert([
          'total'=> $request->add_book,
          'now_total'=> $request->add_book,
          'add_book'=> $request->add_book,
          'sale'=>0,
          'customer_id'=>0,
          'created_at'=>Carbon::now()

        ]);
      }

     return redirect('/books');
    }


//Cash
    function cashview()
    {
      $cashs = Cash::orderBy('id', 'desc')->paginate(10);


      $total_amount = Customer::sum('payment');
      $total_diposit = Cash::sum('amount');
      $total_due = $total_amount-$total_diposit;
      $cost_amount =  Cost::sum('amount');
      $due_amount = $total_due - Cost::sum('amount');

      return view('cash', compact('cashs','total_amount','total_diposit','total_due','cost_amount','due_amount',));
    }
    function cashadd()
    {
      return view('cash_add');
    }
    function cashaddinsert(Request $request)
    {
      Cash::insert([
        'by'=> $request->by,
        'amount'=> $request->amount,
        'created_at'=> Carbon::now(),
      ]);
      return redirect('/cash');
    }

  // COst
  function costview()
  {
    $costs = Cost::orderBy('id', 'desc')->paginate(10);
    $total = Cost::sum('amount');
    return view('cost', compact('costs','total'));
  }
  function costadd()
  {
    return view('cost_add');
  }
  function costaddinsert(Request $request)
  {
    Cost::insert([
      'title'=> $request->title,
      'amount'=> $request->amount,
      'created_at'=> Carbon::now(),
    ]);
    return redirect('/cost');
  }

  

  function pdf()
  {
    $customers = Customer::orderBy('id', 'desc')->get();
    $total_book = Customer::sum('quantity');
      $total_amount = Customer::sum('total');
      $total_payment = Customer::sum('payment');
      $total_due = Customer::sum('due');

    $data = '
  <!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>
  .main{
    width: 100%;
    max-width: 95%;
    margin: 0 auto;
    font-size: 14px;

  }
  table, tr, th, td{
     border: 1px solid black;
     padding: 2px;
  }
  table {
  border-collapse: collapse;
  }
</style>
</head>
<body>
<div class="main">
<div style="text-align: center;"><h1 >Customer Details</h1></div>
        <div >
          <table  >
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
               
              </tr>
            </thead>
            <tbody>';
              $loop = 0;
              foreach ($customers as $customer){
                $loop =$loop+1 ;
              $data .= '<tr>
                 <th scope="row">'. $loop .'</th>
                 <td>'. $customer->created_at->format("d-m-y") .'</td>
                 <td>'. $customer->customer_code .'</td>
                 <td>'. $customer->name .'</td>
                 <td>'. $customer->mobile .'</td>
                 <td>'. $customer->quantity .'</td>
                 <td>'. $customer->rate .'</td>
                 <td>'. $customer->discount .'</td>
                 <td>'. $customer->total .'</td>
                 <td>'. $customer->payment .'</td>
                 <td>'. $customer->due .'</td>  
               </tr>
               ';
          }
           $data .= '  <tr >
               <td colspan="4"></td>
               <td><strong>Total Book Sold</strong> </td>
               <td>'. $total_book .'</td>
               <td colspan="2"><strong>Total Amount</strong> </td>
               <td>'. $total_amount .'</td>
               <td>'. $total_payment .'</td>
               <td>'. $total_due .'</td>
               
             </tr>
            </tbody>
        
           </table>
        </div>
</div>
</body>
</html>

    ';

    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($data);
    return $pdf->stream();
   
  }

  function pdfcustomer($id)
  {
    $customerInfo = Customer::where('id', $id)->first();

    $data = '
  <!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>
  .main{
    width: 100%;
    max-width: 50%;
    margin: 0 auto;
    font-size: 20px;

  }
  table, tr, th, td{
     border: 1px solid black;
     padding: 5px;
  }
  table {
    border-collapse: collapse;

  }
</style>
</head>
<body>
<div style="text-align: center;"><h1 >Customer Personal Information</h1></div>
<div class="main">

             <div class="col-md-6 p-3">
                <h3 style="text-align: center;">'. $customerInfo->name .'</h3>
            </div>
           
         
          <table class="table table-bordered my-2">

            <tbody >
               <tr>
                <td>Book Quantity</td>
                <td class="text-right">'. $customerInfo->quantity  .'</td>
               </tr>
               <tr>
                <td>Sales Quantity</td>

                <td class="text-right">'. $customerInfo->sale  .'</td>
               </tr>
               <tr>
                <td>Book Price</td>
                <td class="text-right">'. $customerInfo->rate  .'</td>
               </tr>
               <tr>
                 <td>Discount</td>
                 <td class="text-right">'. $customerInfo->discount .'</td>
               </tr>
               <tr>
                <td>Total Amount</td>
                <td class="text-right">'. $customerInfo->total  .'</td>
               </tr>
               <tr>
                 <td>Total Payment</td>
                 <td class="text-right">'. $customerInfo->payment .'</td>
               </tr>
               <tr>
                 <td>Total Due</td>
                 <td class="text-right">'. $customerInfo->due .'</td>
               </tr>
               <tr>
                 <td>Mobile NO</td>
                  <td class="text-right">'. $customerInfo->mobile .'</td>
               </tr>
               <tr>
                 <td>Address</td>
                 <td class="text-right">'. $customerInfo->address .'</td>
               </tr>
            </tbody>
          </table>
</div>
</body>
</html>

    ';

    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($data);
    return $pdf->stream();
  }
}
