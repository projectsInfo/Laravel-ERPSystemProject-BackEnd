<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use DataTables;

class DepartmentController extends Controller
{


   /**
     * Display a listing of the resource.
     * index of Department
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('Department')) {
        //     return redirect()->back()->with('delete',  'ليس لديك صلاحيه للدخول');
        // }
       
        $Roles = Role::orderBy('id')->paginate(10);
        $permissions = Permission::get()->pluck('name', 'name');
        
        return view('Hr.Department.index', compact('Roles','permissions'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'required|exists:permissions,name',
        ]);
        $role = Role::create(Request()->except('permissions'));
        $permissions = Request()->input('permissions') ? Request()->input('permissions') : [];
        $role->syncPermissions($permissions);
        return response()->json([
            'status' => true,
            'linkShowAll' => trans('admin.response_message_add'),
            'Message' => trans('Message.DepartmentSuccess')
        ]);

    }



        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Role = Role::findOrFail($id);
        if ($Role != null) {
            if($Role->permissions()->pluck('name')->count() > 0){
                $permissions = $Role->permissions()->pluck('name');
            }
             return response()->json(['status' => true,'data' => $Role,'permissions' => $permissions , 'message' => ' type has been deleted successfully']);
         } else {
             return response()->json(['status' => false, 'message' => ' No user']);
         }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|unique:roles,name,'.$id,
            'permissions' => 'required|exists:permissions,name',
        ]);

        $role = Role::findOrFail($id);

        if ($role != null) {
            
            $role->update([
                'name' => $request->name,
            ]);

            $permissions = Request()->input('permissions') ? Request()->input('permissions') : [];
            $role->syncPermissions($permissions);

            return response()->json([
                'status' => true,
                'linkShowAll' => trans('admin.response_message_add'),
                'Message' => trans('Message.DepartmentSuccessUpdate')
            ]);
         } else {
             return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
         }
       
      
     
    }

    /**
     * dataTables.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getCustomFilterData(Request $request)
    {
        $Roles = Role::select('*');
        // dd($Roles);

        return Datatables::of($Roles)
            ->filter(function ($query) use ($request) {
                if ($request->has('option')) {
                    if ($request->option == 'name') {
                        $query->where('name', 'like', "%{$request->get('input')}%");
                    } 
                    else if ($request->option == 'pages') {
                        $input = $request->input;
                        $query->whereHas("permissions", function($q) use($input){ $q->where("name",'like', "%{$input}%" ); });
                    }
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $botton = '<button type="button" edit-url="'. route('department.edit',$query->id) .'"   class="mr-2 edit-Btn edit btn">
                        <span><i class="fas fa-edit fa-fw"></i></span>
                    </button>
    
                    <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn delBtns delet" del-url="'.route('department.index').'/'.$query->id .'">
                        <span><i class="fas fa-times fa-fw"></i></span>
                    </button>';
                return $botton;
            })
            ->addColumn('permissions', function ($Role) {
                $options = '';
                foreach ($Role->permissions()->pluck('name') as $permission) {
                    $options .= '<span>'. $permission. '</span> ,';
                }
                return $options;
            }) 
           ->rawColumns(['action','permissions','id'])
            ->make(true);
    }


      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
         if ($role != null) {
             $role->delete();
             return response()->json(['status' => true, 'Message' => trans('Message.DepartmentSuccessDestroy')]);
         } else {
             return response()->json(['status' => false, 'Message' => trans('Message.DepartmentNotSuccessDestroy')]);
         }
    }
}
