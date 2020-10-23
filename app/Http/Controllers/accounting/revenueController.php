<?php

namespace App\Http\Controllers\accounting;

use App\revenue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class revenueController extends Controller
{

    // ============================= revenue bill ===============================
    public function revenue_bill(){
        return view('accounting.Revenues.revenue-bill');
    }

    public function store_revenue_bill(Request $request){
        $insert = new revenue();
        $insert-> transnum = $request->input('operation_number');
        $insert-> currency = $request->input('currency_type');
        $insert-> debit_acc = 10000; // Treasury
        $insert-> credit_acc = $request->input('account_name');
        $insert-> debit_amount = $request->input('amount_numbers'); // Equal each other from cash
        $insert-> credit_amount = $request->input('amount_numbers');// Equal each other from cash
        $insert-> trans_id = 10; // Upload file
        $insert-> total_amount = $request->input('amount_numbers');// Equal each other from cash
        $insert-> cheque_id = 20; // Id from another table will be creat
        $insert->save();

        return view('accounting/Revenues/revenue-bill');

//        dd($request);
    }
    //============================= revenue customer orders ====================

    public function revenue_customer_orders(){
        return view('accounting.Revenues.revenue-customer-orders');
    }

    public function store_revenue_customer_orders(Request $request){






//        dd($request);

    }

    //============================= revenue shipping company ====================


    public function revenue_shipping_company(){
        return view('accounting.Revenues.revenue_shipping_company');
    }

    public function store_revenue_shipping_company(Request $request){
        dd($request);

    }


}
