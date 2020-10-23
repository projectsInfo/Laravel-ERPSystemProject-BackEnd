<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;
use App\SubProduct;
class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function pdf()
    {
            $Users = SubProduct::get();
            $pdf = PDF::loadView('preint',compact('Users'))->setPaper($customPaper, 'landscape');
            $pdf->save(storage_path().'_filename.pdf');
            return $pdf->stream('preint', [
                "Attachment" => true
            ]);
    }

    public function ajax(Request $request)
    {
        $SubProduct = SubProduct::all();
        // return $SubProduct;
        return response()->json([
            'status' => true,
            'linkShowAll' => $SubProduct,
            'message' => trans('admin.response_message_add')
        ]);

    }
}
