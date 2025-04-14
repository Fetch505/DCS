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
use App\Models\HealthAndSafety;
use App\Models\HealthCategory;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class HealthAndSafetyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $healths = HealthAndSafety::all();
      return view('Super_Admin.health_and_safety.index')->withHealths($healths);
    }

    public function create()
    {
        $category = HealthCategory::pluck('name','id');
        return view('Super_Admin.health_and_safety.add')->withCategory($category);
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
      $video_url = asset('health_and_safety/' . $filename);

      try{
          $health = new HealthAndSafety;
          $health->category_id = $request->category_id;
          $health->title = $request->title;
          $health->description = $request->description;
          $health->video_url = $video_url;
          $health->created_at = Carbon::now();
          $health->updated_at = Carbon::now();
          $health->save();

          $file->move(public_path('health_and_safety'), $filename);

          $message = 'Video Uploaded';
          $status = true;
        }
        catch (\Exception $e) {
          File::delete($video_url);
          $message = 'There was an error while uploading the video';
      }

      return response()->json([
          'status' => $status,
          'message' => $message,
          'video_url' => $video_url,
      ], 200);
    }

    public function edit(HealthAndSafety $health)
    {
      $category = HealthCategory::pluck('name','id');
      return view('Super_Admin.health_and_safety.edit', [
        'health' => $health,
        'category' => $category,
        'exception' => false,
      ]);
    }

    public function deleteRecord(HealthAndSafety $health)
    {
        HealthAndSafety::where('id','=',$health->id)->delete();
        return redirect()->route('health.index');
    }

    public function update(Request $request, HealthAndSafety $health)
    {
      $request->validate([
        'category_id' => 'required',
        'title' => 'required|max:255',
        'description' => 'required|max:255',
      ]);

      $category = HealthCategory::pluck('name','id');
      if ($request->hasFile('file') == null){
          $health                 = HealthAndSafety::where('id','=',$health->id)->first();
          $health->category_id    = $request->category_id;
          $health->title          = $request->title;
          $health->description    = $request->description;
          $health->updated_at     = carbon::now();
          $health->save();

          if (App::getLocale() == "en") {
            Session::flash('success','updated successfully');
          }else {
            Session::flash('success','succesvol updated');
          }

          return view('Super_Admin.health_and_safety.edit', [
            'health' => $health,
            'category' => $category,
            'exception' => false,
          ]);
      }
      else
      {
        $file     = $request->file('file');
        $video_name = $file->getClientOriginalName();
        $name = pathinfo($video_name, PATHINFO_FILENAME);
        $extension = pathinfo($video_name, PATHINFO_EXTENSION);
        $filename = $name . '_' . time() . '.' . $extension;
        $video_url = asset('health_and_safety/' . $filename);
        $oldfilename = $request->file_name;
        $oldfilepath = public_path('health_and_safety/' . $oldfilename);

        try{
          $health                 = HealthAndSafety::where('id','=',$health->id)->first();
          $health->category_id    = $request->category_id;
          $health->title          = $request->title;
          $health->description    = $request->description;
          $health->video_url      = $video_url;
          $health->updated_at     = carbon::now();
          $health->save();

          $videoPath = $file->move(public_path('health_and_safety'), $filename);
          File::delete($oldfilepath);

          if (App::getLocale() == "en") {
            Session::flash('success','updated successfully');
          }else {
            Session::flash('success','succesvol updated');
          }
          return view('Super_Admin.health_and_safety.edit', [
            'health' => $health,
            'category' => $category,
            'exception' => false,
          ]);
        }
        catch (\Exception $e) {
          File::delete($video_url);
          Log::error('An error occurred: ' . $e->getMessage());
          return view('Super_Admin.health_and_safety.edit', [
            'health' => $health,
            'exception' => true,
          ]);
        }
      }
    }
}
