<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\About;
use Illuminate\Support\Str;
use DataTables;
use Validator;
use Gate;
use Auth;
use Carbon\Carbon;


class AboutController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //All Data
    public function All(){

        if(request()->ajax())
        {
            $data = About::with('creator', 'publisher')->get();

            //dd($data);

            return DataTables::of($data)


                ->addColumn('details', function($data){
                    $button = '';

                    $button .= '<b>Details : </b>'.$data->details.'<br>';

                    if($data->creator){
                        $button .= '<span class="text-muted"><b>Created By : </b>'.$data->creator->name.'</span>';
                    }

                    if($data->publisher){
                        $button .= ', <span class="text-muted"><b>Pablished By : </b>'.$data->publisher->name.'.</span>';
                    }


                    if(empty($button)){
                        return 'No data';
                    }

                    return $button;
                })


                ->addColumn('action', function($data){

                    $button = '';

                    if(Gate::allows('publisher', 'about')){

                        if($data->status == 1){
                            $button .= '<button type="button" id="'.$data->id.'" makeValue="0"  class="deactiveStatus btn btn-info btn-sm"><i class="fa fa-check-square-o"></i> Active</button>';
                        }else{
                            $button .= '<button type="button" id="'.$data->id.'" makeValue="1" class="activeStatus btn btn-warning btn-sm"> <i class="fa fa-window-close-o"></i> Deactive</button>';
                        }

                    }

                    if(Gate::allows('creator', 'about')){

                        $button .= '<button type="button" id="'.$data->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" ></i> Edit</button>';
                    }


                    if( Gate::allows('delete', 'about') ){
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete</button>';
                    }

                    return $button;
                })

                ->rawColumns(['details', 'action'])
                ->make(true);
        }
        return view('admin.food.all-about');
    }

    //insert
    public function Store(Request $request)
    {
        if(Gate::denies('creator')){
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $rules = array(
            'details'   =>  'required|min:3|max:20000',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else{

            //dd($request);

            $data = new About();

            $data->details     =   $request->details;
            $data->created_by  =   Auth::user()->id;

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
            $data = About::findOrFail($id);
            return response()->json($data);
        }
    }

    //Update
    public function Update(Request $request){

        if(Gate::denies('creator')){
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $id = $request->hidden_id;

        $rules = array(
            'details'   =>  'required|min:3|max:20000',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else{

            $data = About::find($id);

            $data->details     =   $request->details;
            $data->created_by = Auth::user()->id;
            $data->updated_at = Carbon::now();


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

        if(Gate::denies('delete')){
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $data = About::findOrFail($id);


        $success = $data->delete();

        if($success){
            return response()->json(['success' => 'Successfully Deleted', 'icon' => 'success']);
        }else{
            return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
        }
    }


    //Status Active/Deactive
    public function Status($id, $val){

        if(Gate::denies('publisher')){
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $data = About::find($id);

        $data->status = $val;
        $data->published_by = Auth::user()->id;

        $success = $data->save();

        if($success){
            return response()->json(['success' => 'Successfully Updated', 'icon' => 'success']);
        }else{
            return response()->json(['success' => 'Something going wrong !!', 'icon' => 'error']);
        }

    }

}

