<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Product;
use DB;

class TransactionController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    
      //mengambil data darri database menggunakan db::table() dan disimpan ke dalam $data
      //menggunakan ->join() untuk menggabungkan tabel lainnya
      //diakhir get() untuk mengambil data array

      //diakhir first() jika hanya satu data yang diambil

      $data = DB::table('customers')
              ->join('products', 'products.id_products', '=', 'customers.id_products')
              ->get();

      $total_sum = DB::table('customers')
              ->join('products', 'products.id_products', '=', 'customers.id_products')
              ->sum(DB::raw('products.price * customers.quantity'));
                      
      return view('pages.transactions.index',compact('data','total_sum'));  
  }


}
