<?php

namespace App\Http\Controllers\accounting;

use App\expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class expensesController extends Controller
{
    // ============================= expenses bill ===============================
    public function expenses_bill()
    {
        return view('accounting.Expenses.expenses-bill');
    }

    public function store_expenses_bill(Request $request)
    {

        $insert = new expense();
        $insert->transnum = $request->input('operation_number');
        $insert->currency = $request->input('currency_type');
        $insert->debit_acc = $request->input('account_name');
        $insert->credit_acc = 10000; // Treasury
        $insert->debit_amount = $request->input('amount_numbers'); // Equal each other from cash
        $insert->credit_amount = $request->input('amount_numbers');// Equal each other from cash
        $insert->trans_id = 10; // Upload file
        $insert->total_amount = $request->input('amount_numbers');// Equal each other from cash
        $insert->cheque_id = 20; // Id from another table will be creat
        $insert->save();

        return view('accounting/Expenses/expenses-bill');


//        dd($request);
    }

    //============================= expenses customer orders ====================

    public function expenses_customer_orders()
    {
        return view('accounting.Expenses.expenses-customer-orders');
    }

    public function store_expenses_customer_orders(Request $request)
    {
        dd($request);

    }

    //============================= expenses shipping company ====================


    public function expenses_shipping_company()
    {
        return view('accounting.Expenses.expenses_shipping_company');
    }

    public function store_expenses_shipping_company(Request $request)
    {
        dd($request);

    }
}
