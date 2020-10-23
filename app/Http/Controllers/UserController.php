<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Auth;
use JavaScript;
use App\DataTables\UsersDataTable;
use App\Http\Requests\UserStoreRequest;
use DataTables;
use App\User;
use Image;
class UserController extends Controller
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
        $trans = [
            'create_user' => trans('mangeUser.create_user'),
        ];
        JavaScript::put([
            'manage' => $trans,
        ]);
        $Users = User::orderBy('id')->paginate(10);
        $Roles = Role::get()->pluck('name', 'name');
        // return $Users->render('Hr.Manage_users.index', compact('Roles'));
        return view('Hr.Manage_users.index', compact('Roles'));
    }

    public function profile(){
        $user = Auth::user() ;
        return view('Hr.Manage_users.profile', compact('user'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $User = new User;
        $User = $this->persist($User);
        $User->assignRole($request->departments);

        return response()->json([
            'status' => true,
            'linkShowAll' => trans('admin.response_message_add'),
            'Message' => trans('Message.UserSuccess')
        ]);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        if ($User != null) {
            $departments = 0 ;
            if($User->roles()->pluck('name')->count() > 0){
                $departments = $User->roles()->pluck('name')[0];
            }
             return response()->json(['status' => true,'data' => $User,'departments' => $departments , 'message' => ' type has been deleted successfully']);
         } else {
             return response()->json(['status' => false, 'Message' => ' No user']);
         }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $name)
    {
        //
        $User = User::where('name',$name)->get()->first();
        $this->validate($request, [
            'name' => 'required|string|regex:/^[\p{L} ]+$/u|max:255',
            'email' => 'required|string|max:255|unique:users,email,'.$User->id,
            'password' => 'sometimes|nullable|confirmed|min:6',
            'departments' => 'sometimes|nullable|exists:roles,name',
            'mobile' => 'required|string|numeric|min:11|unique:users,mobile,'.$User->id,
            'address' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'avatar' => 'sometimes|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file' => 'sometimes|nullable|mimes:docx,pdf|max:2048',
        ]);
        if ($User != null) {
            $profileImgIn = $User->avatar ;
            if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $profileImgIn = time(). '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $profileImgIn));
            }
    
            $filename = $User->file;
            if($request->hasFile('file')){
                $avatar = $request->file('file');
                $filename = time(). '.' . $avatar->getClientOriginalExtension();
                $request->file('file')->move(public_path('/uploads/files'), $filename);
            }

            $User = $this->persist($User);
            $User->update([
                'file' => $filename,
                'avatar' => $profileImgIn,
            ]);
            $User->syncRoles($request->departments);
    
            return response()->json([
                'status' => true,
                'linkShowAll' => trans('admin.response_message_add'),
                'Message' => trans('Message.UserSuccessUpdate')
            ]);
         } else {
             return response()->json(['status' => false, 'message' => ' type has been deleted Not successfully']);
         }
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        dd($User);
        // $Suppler->deactivate();
        $subscriber->statistics = $subscriber->statistics();
        return view('subscribers.show', compact('subscriber'));
    }
      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        //
        if ($User != null) {
            $User->delete();
             return response()->json(['status' => true, 'Message' => trans('Message.UserSuccessDestroy')]);
         } else {
             return response()->json(['status' => false, 'Message' => trans('Message.UserNotSuccessDestroy')]);
         }
    }


    public function getCustomFilterData(Request $request)
    {
        $Users = User::select('*');
        return Datatables::of($Users)
            ->filter(function ($query) use ($request) {
                if ($request->has('option')) {
                    if ($request->option == 'name') {
                        $query->where('name', 'like', "%{$request->get('input')}%");
                    }else if ($request->option == 'Phone') {
                        $query->where('mobile', 'like', "%{$request->get('input')}%");
                    }else if ($request->option == 'email') {
                        $query->where('email', 'like', "%{$request->get('input')}%");
                    }else if ($request->option == 'Department') {
                        $input = $request->input;
                        $query->whereHas("roles", function($q) use($input){ $q->where("name",'like', "%{$input}%" ); });
                    }
                }
            })
            ->addIndexColumn()
        
            ->addColumn('action', function ($user) {
                $botton = '<button type="button" edit-url="'. route('manage_users.edit',$user->name) .'"   class="mr-2 edit-Btn edit btn">
                        <span><i class="fas fa-edit fa-fw"></i></span>
                    </button>
    
                    <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn delBtns delet" del-url="'.route('manage_users.index').'/'.$user->name .'">
                        <span><i class="fas fa-times fa-fw"></i></span>
                    </button>';
                return $botton;
            })
            ->addColumn('departments', function ($user) {
                $options = '';
                foreach ($user->roles()->pluck('name') as $role) {
                    $options .= '<span>'. $role. '</span> ';
                }
                return $options;
            }) 
           ->rawColumns(['action','departments','id'])
            ->make(true);
    }


    private function persist(User $user)
    {
        $columns = ['name', 'email', 'mobile', 'address', 'gender'];


        foreach ($columns as $column) {

            $value = request($column);

            if (!is_null($value)) {

                $user->$column = $value;
            }
        }
       

        if (request()->filled('password')) {
            $user->password = Hash::make(request('password')) ;
        }

        if (request()->isMethod('post')) {
            
            $profileImgIn = 'default.png';
            if (request()->file('avatar')) {
                $avatar = request()->file('avatar');
                $profileImgIn = time(). '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $profileImgIn));
            }
            
            $filename = null;
            if(request()->file('file')){
                $file = request()->file('file');
                $filename = time(). '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/uploads/files'), $filename);
            }
            $user->avatar = $profileImgIn;
            $user->file = $filename;
        }
        $user->save();

        return $user;

    }
}
