<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Str;
use DataTables;
use Validator;
use Gate;
use Image;
use Auth;
use Carbon\Carbon;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //All Data
    public function All(){

        if(request()->ajax())
        {
            $data = Post::with('publisher', 'creator')->get();

            //dd($data);

            return DataTables::of($data)

                ->addColumn('ImgSrc', function($data){
                    $button = '';
                    if(!empty($data->image_small)){
                        $button = '<img src="'.asset($data->image_small).'" class="rounded mx-auto d-block" height="150" width="200" >';
                    }else{
                        $button = 'No Image';
                    }

                    return $button;
                })


                ->addColumn('details', function($data){
                    $button = '';

                    $button .= '<b>Title : </b>'.$data->title.'<br>';
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

                    if(Gate::allows('publisher', 'post')){

                        if($data->status == 1){
                            $button .= '<button type="button" id="'.$data->id.'" makeValue="0"  class="deactiveStatus btn btn-info btn-sm"><i class="fa fa-check-square-o"></i> Active</button>';
                        }else{
                            $button .= '<button type="button" id="'.$data->id.'" makeValue="1" class="activeStatus btn btn-warning btn-sm"> <i class="fa fa-window-close-o"></i> Deactive</button>';
                        }

                    }

                    if(Gate::allows('creator', 'post')){

                        $button .= '<button type="button" id="'.$data->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" ></i> Edit</button>';
                    }


                    if( Gate::allows('delete', 'post') ){
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete</button>';
                    }

                    return $button;
                })

                ->rawColumns(['ImgSrc', 'details', 'action'])
                ->make(true);
        }
        return view('admin.food.all-posts');
    }

    //insert
    public function Store(Request $request)
    {
        if(Gate::denies('creator')){
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $rules = array(
            'title'    =>  'required|unique:posts|min:3|max:300',
            'details'    =>  'required|min:3|max:20000',
            'image' => 'required|max:500|mimes:jpg,jpeg,png',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else{

            //dd($request);

            $data = new Post();

            $data->title    =   $request->title;
            $data->details     =   $request->details;
            $data->created_by = Auth::user()->id;



            $image = $request->file('image');
            if ($image) {
                $image_name = "post".Str::random(5);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                //Small ImageUpload Path
                $upload_path_small = 'public/images/posts/small/';
                $image_url_small = $upload_path_small . $image_full_name;

                //Image Resize
                $resize_image = Image::make($image->getRealPath());
                $resize_image->resize(150, 200, function($constraint){
                     $constraint->aspectRatio();
                })->save($upload_path_small . '/' . $image_full_name);

                //Original Image Upload Path
                $upload_path_original = 'public/images/posts/original/';
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
            $data = Post::findOrFail($id);
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
            'title'    =>  'required|min:3|max:300|unique:posts,title,'.$id,
            'details'    =>  'required|min:3|max:20000',
            'image' => 'nullable|max:500|mimes:jpg,jpeg,png',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else{

            $data = Post::find($id);

            $data->title    =   $request->title;
            $data->details     =   $request->details;
            $data->created_by = Auth::user()->id;
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
                $image_name = "post".Str::random(5);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                //Small ImageUpload Path
                $upload_path_small = 'public/images/posts/small/';
                $image_url_small = $upload_path_small . $image_full_name;

                //Image Resize
                $resize_image = Image::make($image->getRealPath());
                 $resize_image->resize(100, 100, function($constraint){
                     $constraint->aspectRatio();
                })->save($upload_path_small . '/' . $image_full_name);

                //Original Image Upload Path
                $upload_path_original = 'public/images/posts/original/';
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

        if(Gate::denies('delete')){
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $data = Post::findOrFail($id);

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


    //Status Active/Deactive
    public function Status($id, $val){

        if(Gate::denies('publisher')){
            return response()->json(['success' => 'Sorry !! You have no access.', 'icon' => 'error']);
        }

        $data = Post::find($id);

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
