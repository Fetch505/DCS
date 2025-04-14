<?php

namespace App\Http\Controllers\SuperAdmin;
use URL;
use DB;
use PDF;
use App;
use Hash;
use Auth;
use Lang;
use Session;
use Carbon\Carbon;
use App\Models\Methods;
use App\Models\MethodCategory;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $methods = Methods::all();
      return view('Super_Admin.methods.index')->withMethods($methods);
    }

    public function create()
    {                            
        $category = MethodCategory::pluck('name','id');
        return view('Super_Admin.methods.add')->withCategory($category);
    }

    public function store(Request $request)
  {
    $request->validate([
        'category_id' => 'required',
        'title' => 'required|max:255',
        'description' => 'required|max:255',
        'file' => 'required',
    ]);

    $video_url = '';
    $status = false;

    $file = $request->file('file');
    $extension = $file->getClientOriginalExtension();
    $video_name = $file->getClientOriginalName();
    $name = pathinfo($video_name, PATHINFO_FILENAME);
    $filename = $name . '_' . time() . '.' . $extension;

    if ($file->move(public_path('methods'), $filename)) {
        $video_url = asset('public/methods/' . $filename);

        $method = new Methods;
        $method->category_id = $request->category_id;
        $method->title = $request->title;
        $method->description = $request->description;
        $method->video_url = $video_url;
        $method->created_at = Carbon::now();
        $method->updated_at = Carbon::now();
        $method->save();

        $message = 'Video Uploaded';
        $status = true;
    } else {
        $message = 'There was an error while uploading the video';
    }

    return response()->json([
        'status' => $status,
        'message' => $message,
        'video_url' => $video_url,
    ], 200);
  }


    public function edit(Methods $method)
    {
      $category = MethodCategory::pluck('name','id');
      return view('Super_Admin.methods.edit', [
        'method' => $method,
        'category' => $category,
        'exception' => false,
      ]);
    }

    public function update(Request $request, Methods $method)
    {
      $request->validate([
        'category_id' => 'required',
        'title' => 'required|max:255',
        'description' => 'required|max:255',
        'file' => 'mimes:mp4,avi,mov,wmv'
      ]);

      $method                 = Methods::where('id','=',$method->id)->first();
      $method->category_id    = $request->category_id;
      $method->title          = $request->title;
      $method->description    = $request->description;
      $method->updated_at     = carbon::now();

      if ($request->hasFile('file')){   
        $file     = $request->file('file');
        $video_name = $file->getClientOriginalName();
        $name = pathinfo($video_name, PATHINFO_FILENAME);
        $extension = pathinfo($video_name, PATHINFO_EXTENSION);
        $filepath = URL::asset('public/methods/');
        $filename = $name . '_' . time() . '.' . $extension;

        try{
          $video_url = asset('public/methods/' . $filename);
          $method->video_url      = $video_url;
          $method->save();

          // move_uploaded_file($file,$video_url);
          $videoPath = $file->move(public_path('methods'), $filename);
        }
        catch (\Exception $e) {
          Log::error('An error occurred: ' . $e->getMessage());
          return view('Company_Admin.methods.edit', [
            'method' => $method,
            'exception' => true,
          ]);
        }
      }
      else
      {         
          $method->save();
      }

      if (App::getLocale() == "en") {
        Session::flash('success','Methods updated successfully');
      }else {
        Session::flash('success','Methods succesvol updated');
      }
    
      $category = MethodCategory::pluck('name','id');
      return view('Super_Admin.methods.edit', [
        'method' => $method,
        'category' => $category,
        'exception' => false,
      ]);
    }

    public function deleteRecord(Methods $method)
    {
        Methods::where('id','=',$method->id)->delete();
        return redirect()->route('method.index');
    }

}