<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use DataTables;
use Validator;
use Gate;

class RoleController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    //All Data
    public function All(){


        if(request()->ajax())
        {
            $data = Role::latest()->get();

            //dd($data);

            return DataTables::of($data)

                ->addColumn('action', function($data){

                    $button = '';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm" >Edit</button>';
                    if( Gate::allows('delete') ){
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                    }
                    return $button;
                })

                ->rawColumns(['action'])
                ->make(true);
        }



        return view('admin.food.all-roles');
    }


    //insert
    public function Store(Request $request)
    {
        $rules = array(
            'name'    =>  'required|unique:roles|max:50',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else{

            //Make First capital
            $rName = ucwords(strtolower($request->name));

            $data = new Role();

            $data->name = $rName;
            $success = $data->save();


            if($success){
                return response()->json(['success' => 'Successfully Inserted', 'icon' => 'success']);
            }else{
                return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
            }
        }



    }

    //Edit
    public function Edit($id){

        $data = Role::findOrFail($id);

        if(request()->ajax())
        {
            $data = Role::findOrFail($id);
            return response()->json($data);
        }
    }

    //Update
    public function Update(Request $request){

        $id = $request->hidden_id;

        $rules = array(
            'name'    =>  'required|unique:roles,name,'.$id,
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else
        {

            $rName = ucwords(strtolower($request->name));

            $data = Role::findOrFail($id);

            $data->name = $rName;
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

        $data = Role::findOrFail($id);
        $success = $data->delete();

        if($success){
            return response()->json(['success' => 'Successfully Deleted', 'icon' => 'success']);
        }else{
            return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
        }
    }




}
