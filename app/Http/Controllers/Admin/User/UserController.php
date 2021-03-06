<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Role;
use DataTables;
use Validator;
use Gate;
use Image;
use Carbon\Carbon;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    //All Data
    public function All(){

        if(request()->ajax())
        {
            $data = User::with('roles')->get();

            //dd($data);

            return DataTables::of($data)

                ->addColumn('ImgSrc', function($data){
                    $button = '';
                    if(!empty($data->image_small)){
                        $button = '<img src="'.asset($data->image_small).'" class="rounded mx-auto d-block" height="100" width="100" >';
                    }else{
                        $button = 'No Image';
                    }

                    return $button;
                })



                ->addColumn('roles', function($data){
                    $button = '';
                    $button = implode(', ', $data->roles()->pluck('name')->toArray());

                    if(empty($button)){
                        return 'No Role';
                    }

                    return $button;
                })

                ->addColumn('details', function($data){
                    $button = '';
                    $button .= '<b>Login ID</b> : '.$data->login."<br>";
                    $button .= '<b>Name</b> : '.$data->name."<br>";
                    $button .= '<b>Contact</b> : '.$data->contact."<br>";

                    if(empty($button)){
                        return 'No data';
                    }

                    return $button;
                })


                ->addColumn('action', function($data){

                    $button = '';
                    $button .= '<button type="button" id="'.$data->id.'" class="edit btn btn-primary btn-sm" >Edit</button>';

                    if( Gate::allows('delete') ){
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                    }

                    if( Gate::allows('roleManage') ){
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="roleToUser btn btn-info btn-sm">Add Role</button>';
                    }

                    return $button;
                })

                ->rawColumns(['ImgSrc', 'details', 'roles', 'action'])
                ->make(true);
        }



        return view('admin.food.all-users');
    }

    //insert
    public function Store(Request $request)
    {
        $rules = array(
            'login'    =>  'required|unique:users|min:3|max:20',
            'name'    =>  'required|min:3|max:50',
            'email'    =>  'required|email|max:50',
            'contact' => 'required|regex:/(01)[0-9]{9}/|max:11',
            'image' => 'required|max:500|mimes:jpg,jpeg,png',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else{

            //dd($request);

            $data = new User();

            $data->login    =   $request->login;
            $data->name     =   $request->name;
            $data->email    =   $request->email;
            $data->contact  =   $request->contact;
            $data->password =   Hash::make('5683');


            $image = $request->file('image');
            if ($image) {
                $image_name = $request->name.Str::random(5);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                //Small ImageUpload Path
                $upload_path_small = 'public/images/users/small/';
                $image_url_small = $upload_path_small . $image_full_name;

                //Image Resize
                $resize_image = Image::make($image->getRealPath());
                 $resize_image->resize(100, 100, function($constraint){
                     $constraint->aspectRatio();
                })->save($upload_path_small . '/' . $image_full_name);

                //Original Image Upload Path
                $upload_path_original = 'public/images/users/original/';
                $image_url_original = $upload_path_original . $image_full_name;

                Image::make($image)->save($image_url_original);

                //Data Store In DB Object
                $data->image_small = $image_url_small;
                $data->image = $image_url_original;

            }


            $success= $data->save();

            if($success){
                return response()->json(['success' => 'Successfully Inserted', 'icon' => 'success']);
            }else{
                return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
            }
        }



    }

    //Edit
    public function Edit($id){

        if(request()->ajax())
        {
            $data = User::findOrFail($id);
            return response()->json($data);
        }
    }

    //Update
    public function Update(Request $request){

        $id = $request->hidden_id;

        $rules = array(
            'login'    =>  'required|min:3|max:20|unique:users,login,'.$id,
            'name'    =>  'required|min:3|max:50',
            'email'    =>  'required|email|max:50',
            'contact' => 'required|regex:/(01)[0-9]{9}/|max:11',
            'image' => 'nullable|max:500|mimes:jpg,jpeg,png',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else{

            $data = User::find($id);

            $data->login    =   $request->login;
            $data->name     =   $request->name;
            $data->email    =   $request->email;
            $data->contact  =   $request->contact;
            $data->updated_at = Carbon::now();

            $image = $request->file('image');
            if ($image) {

                //Delete Image
                $image_path = $data->image;
                if(!empty($image_path)){
                     //unlink(public_path($image_path));
                     unlink($image_path);
                }
                //Delete Small Image
                $image_small_path = $data->image_small;
                if(!empty($image_small_path)){
                    unlink($image_small_path);
                }

                //Insert Image
                $image_name = $request->name.Str::random(5);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                //Small ImageUpload Path
                $upload_path_small = 'public/images/users/small/';
                $image_url_small = $upload_path_small . $image_full_name;

                //Image Resize
                $resize_image = Image::make($image->getRealPath());
                 $resize_image->resize(100, 100, function($constraint){
                     $constraint->aspectRatio();
                })->save($upload_path_small . '/' . $image_full_name);

                //Original Image Upload Path
                $upload_path_original = 'public/images/users/original/';
                $image_url_original = $upload_path_original . $image_full_name;

                Image::make($image)->save($image_url_original);

                //Data Store In DB Object
                $data->image_small = $image_url_small;
                $data->image = $image_url_original;

            }

            $success = $data->save();

            if($success){
                return response()->json(['success' => 'Successfully Updated', 'icon' => 'success']);
            }else{
                return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
            }
        }



    }


    //Delete
    public function Delete($id){

        $data = User::findOrFail($id);

        //Delete Image
        $image_path = $data->image;
        if(!empty($image_path)){
             //unlink(public_path($image_path));
             unlink($image_path);
        }
        //Delete Small Image
        $image_small_path = $data->image_small;
        if(!empty($image_small_path)){
            unlink($image_small_path);
        }

        $success = $data->delete();

        if($success){
            return response()->json(['success' => 'Successfully Deleted', 'icon' => 'success']);
        }else{
            return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
        }
    }


    //User RoleEdit
    public function RoleEdit($id){

        $user = User::find($id);
        $roles = Role::get();

       foreach ($roles as $role){

            $check = '';
            //Check role id and user id
            if($user->roles->pluck('id')->contains($role->id)){
                $check .= "checked";
            }

            $data []=['

                <input type="checkbox" class="custom-control-input" id="ch'.$role->id.'"  value="'.$role->id.'" name="roles[]" '. $check.'><label class="custom-control-label" for="ch'.$role->id.'">'.$role->name.' </label>
            '];

       }

       return response()->json($data) ;

    }

    //User Role Update
    public function RoleStore(Request $request){


        $rules = array(
            'roles'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else
        {

            $id = $request->current_user_id;

            $user = User::find($id);

            //Update Role in Roles table
            $success = $user->roles()->sync($request->roles);

            if($success){
                return response()->json(['success' => 'Successfully Updated', 'icon' => 'success']);
            }else{
                return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
            }
        }



    }



}
