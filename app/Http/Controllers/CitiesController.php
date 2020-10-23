<?php

namespace App\Http\Controllers;

use App\Governorate;
use DataTables;
use App\City;

use App\Address;
use Illuminate\Http\Request;
use App\Http\Requests\CityStoreRequest;
use App\Http\Requests\CityUpdateRequest;
use JavaScript;
class CitiesController extends Controller
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
        $trans = [
            'create_user' => trans('mangeUser.create_user'),
        ];
        JavaScript::put([
            'manage' => $trans,
        ]);
        $City = City::orderBy('id')->paginate(10);
        $Governorates = Governorate::get();

        return view('OutSourcing.City.index', compact('City','Governorates'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('OutSourcing.Governorate.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityStoreRequest $request)
    {
        //

        $City = new City; // اضافة مورد جديد
        // $columns = ['mobile','address']; // input name and table name
        // if(fliter_arrays($columns) != false){
        //     return fliter_arrays($columns);// مقارنه بين الانبوت لايجاد متشابهان
        // }
        $City = $this->persist($City);// اضافه للمورد
        // $Governorate = Client::with('Mobiles','Address')->get();
        return response()->json([
            'status' => true,
            // 'Client' => $Client,
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
    public function edit(City $City)
    {
        if ($City != null) {
            return response()->json(['status' => true,'data' => $City , 'message' => ' type has been deleted successfully']);
        } else {
            return response()->json(['status' => false, 'Message' => ' No user']);
        }
  
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(CityUpdateRequest $request, City $City)
    {
        //

        $City = $this->persist($City);// اضافه للمورد
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
    public function destroy(City $City)
    {
        if ($City != null) {
            $City->delete();
            return response()->json(['status' => true, 'message' => ' type has been deleted successfully']);
        } else {
            return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
        }
    }


    private function persist( $City)// اضافة المورد او التعديل
    {
        $columns = ['name','governorates_id'];
        foreach ($columns as $column) {
            $City->$column = request($column);// تعديل او اضافه اسم المورد
        }
        $City->save();

        return $City;
    }    


    public function getCustomFilterData(Request $request)
    {

        $City = City::with('Governorate')->select('*');
        return Datatables::of($City)
            ->filter(function ($query) use ($request) {
                if ($request->has('option')) {
                    if ($request->option == 'Name') {
                        $query->where('name', 'like', "%{$request->get('input')}%");
                    }
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $botton = '
                <button type="button" edit-url="'. route('city.edit',$query->name) .'"   class="mr-2 edit-Btn edit btn">
                    <span><i class="fas fa-edit fa-fw"></i></span>
                </button>
     
                    <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn delBtns delet" del-url="'.route('city.index').'/'.$query->name .'">
                        <span><i class="fas fa-times fa-fw"></i></span>
                    </button>';
                return $botton;
            })
            ->addColumn('Governorate', function ($query) {
                return $query->Governorate->name;
            }) 
            
            
           ->rawColumns(['action','Governorate','id','address','social_accounts'])
            ->make(true);
    }
}
