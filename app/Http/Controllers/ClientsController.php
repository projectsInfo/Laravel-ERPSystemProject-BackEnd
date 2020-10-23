<?php

namespace App\Http\Controllers;

use App\Client;
use DataTables;
use App\Mobiles;
use App\Address;
use Illuminate\Http\Request;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('Department')) {
        //     return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
        // }
        $Clients = Client::orderBy('id')->paginate(10);
        return view('CRM.Clients.index', compact('Clients'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('CRM.Clients.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request)
    {
        //

        $Client = new Client; // اضافة مورد جديد
        $columns = ['mobile','address']; // input name and table name
        if(fliter_arrays($columns) != false){
            return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        }
        $Clients = $this->persist($Client);// اضافه للمورد
        $Client = Client::with('Mobiles','Address')->get();

        return response()->json([
            'status' => true,
            'Client' => $Client,
            'message' => trans('admin.response_message_add')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $Client)
    {
        if ($Client != null) {
            $Client = $Client->statistics() ;
            return view('CRM.Clients.Edit', compact('Client'));
         } else {
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $Client)
    {
        //
        
        $delete_ids_address = explode(',', $request->delete_ids['address']);
        Address::destroy($delete_ids_address);
        
        $delete_ids_mobile = explode(',', $request->delete_ids['mobile']);
        Mobiles::destroy($delete_ids_mobile);
        // dd($delete_ids_address);


        // $Client = new Client; // اضافة مورد جديد
        $columns = ['mobile','address']; // input name and table name
        if(fliter_arrays($columns) != false){
            return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        }
        $Client = $this->persist($Client);// اضافه للمورد
        return response()->json([
            'status' => true,
            'message' => trans('admin.response_message_add'),
            'link' => route('client.index'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $Client)
    {
        if ($Client != null) {
            $Client->delete();
            return response()->json(['status' => true, 'message' => ' type has been deleted successfully']);
        } else {
            return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
        }
    }


    private function persist(Client $Client)// اضافة المورد او التعديل
    {
        $columns = ['name','facebook_account','Whats'];

        foreach ($columns as $column) {
            $Client->$column = request($column);// تعديل او اضافه اسم المورد
        }
        $Client->save();
        $this->add_Client($Client); // اضافة ارقام و بريد وعنوان المورد

        return $Client;
    }    

    private function add_Client( $Client) { // اضافة وتعديل ارقاام وعناوين و اميلات المورد
        $columns = ['mobile','address']; // input name and table name

        $newOpject = ['App\Mobiles','App\Address']; // كلاسات
        $i = 0; // number of array
        foreach ($columns as $column) { // الانبوت
            for ($x = 0; $x < count(request($column)); $x++) {//اضافة او تعديل الكلاسات 
                if(request()->isMethod('put')){// تعديل
                    // dd(request($column.'Id'));
                    $$column = $newOpject[$i]::firstOrNew(['id'=>request($column.'Id')[$x]]); // بحث ان كان الاي دي موجود
                }else{ // اضافة
                    $$column = new $newOpject[$i];  // اضافة كلاس جديد
                }
                $$column->$column = request($column)[$x]; // اضافة الرقم او العنوان او البريد
                $$column->client_id = $Client->id; // id of suppler
                $$column->save();//save
            }
            $i++ ;
        }
    }

    public function getCustomFilterData(Request $request)
    {

        $Clients = Client::select('*');
        return Datatables::of($Clients)
            ->filter(function ($query) use ($request) {
                if ($request->has('option')) {
                    if ($request->option == 'Name') {
                        $query->where('name', 'like', "%{$request->get('input')}%");
                    }else if ($request->option == 'Phone') {
                        $input = $request->input;
                        $query->whereHas("Mobiles", function($q) use($input){ $q->where("mobile",'like', "%{$input}%" ); });
                    }else if ($request->option == 'Address') {
                        $input = $request->input;
                        $query->whereHas("Address", function($q) use($input){ $q->where("address",'like', "%{$input}%" ); });
                    }
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $botton = '
                <a href="'. route('client.edit',$query->name) .'" >
                <button type="button"    class="mr-2 edit-Btn edit btn">
                        <span><i class="fas fa-edit fa-fw"></i></span>
                    </button>
                </a>
                    <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn delBtns delet" del-url="'.route('client.index').'/'.$query->name .'">
                        <span><i class="fas fa-times fa-fw"></i></span>
                    </button>';
                return $botton;
            })
            ->addColumn('mobile', function ($query) {
                $options = '';
                foreach ($query->Mobiles as $Mobiles) {
                    $options .= '<span>'. $Mobiles->mobile. '</span> ,';
                }
                return $options;
            }) 
            ->addColumn('address', function ($query) {
                $options = '';
                foreach ($query->Address as $Address) {
                    $options .= '<span>'. $Address->address. '</span> ,';
                }
                return $options;
            }) 
            ->addColumn('social_accounts', function ($query) {
                $botton = '
                <span><a href="'.$query->facebook_account.'">Facebook</a></span><br>
                <span>whatsapp : '.$query->whats.'</span>';
                return $botton;
            })
           ->rawColumns(['action','mobile','id','address','social_accounts'])
            ->make(true);
    }
}
