<?php

namespace App\Http\Controllers\CompanyAdmin;
use DB;
use PDF;
use App;
use Auth;
use App\Models\Project;
use App\Models\Customer;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Models\ExternalReport;
use App\Models\InspectionReview;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class InspectionReportController extends Controller
{
    public function __constructor()
    {
        $this->middleware('cors');
    }

    public function index()
    {
      $comp_id = Auth::user()->id;
      $inspectionReports = InspectionReview::where('company_id','=',$comp_id)->get();
      return view('Company_Admin.inspection.index')
             ->withInspectionReports($inspectionReports);
    }

    public function externalreportIndex()
    {
      $comp_id = Auth::user()->id;
      $externalReports = ExternalReport::where('company_id','=',$comp_id)
                    ->get();

      return view('Company_Admin.inspection.externalIndex')
                ->withExternalReports($externalReports);
    }

    public function externalreportdata()
    {
        $customers  = Customer::select('id','name')
        ->where('company_id', '=', Auth::id())->get();

      return response()->json([
          'customers' => $customers,
      ],200);
    }

    public function getCustomerProjects($id)
    {
        $projects  = Project::select('id','name')
        ->where('customer_id', '=', $id)->get();

      return response()->json([
          'projects' => $projects,
      ],200);
    }

    public function view($id)
    {
      $inspectionReport = InspectionReview::find($id);
      $tasks = DB::select("SELECT
                        Count(time_cards.id) AS frequency,
                        time_cards.updated_at,
                        tasks.name,
                        time_cards.ratings,
                        time_cards.remarks,
                        users.name as worker_name,
                        locations.name as Location_name,
                        areas.name as area_name,
                        elements.name as element_name
                        FROM
                        days
                        INNER JOIN areas ON days.area_id = areas.id
                        INNER JOIN elements ON days.element_id = elements.id
                        INNER JOIN locations ON days.location_id = locations.id
                        INNER JOIN users ON days.user_id = users.id
                        INNER JOIN tasks ON days.task_id = tasks.id
                        INNER JOIN week_cards ON week_cards.days_id = days.id
                        INNER JOIN time_cards ON time_cards.week_cards_id = week_cards.id
                        WHERE
                        time_cards.inspection_review_id = $id
                        GROUP BY
                        time_cards.updated_at,
                        tasks.name,
                        time_cards.ratings,
                        time_cards.remarks,
                        users.name,
                        locations.name,
                        areas.name,
                        elements.name"
                    );

      return view('Company_Admin.inspection.view')
            ->withTasks($tasks)
            ->withInspectionReport($inspectionReport);
    }

    public function downloadPdfReport($id)
    {
      $inspectionReport = InspectionReview::find($id);

      $tasks = DB::select("SELECT
                        Count(time_cards.id) AS frequency,
                        time_cards.updated_at,
                        tasks.name,
                        time_cards.ratings,
                        time_cards.remarks,
                        users.name as worker_name,
                        locations.name as Location_name,
                        areas.name as area_name,
                        elements.name as element_name
                        FROM
                        days
                        INNER JOIN areas ON days.area_id = areas.id
                        INNER JOIN elements ON days.element_id = elements.id
                        INNER JOIN locations ON days.location_id = locations.id
                        INNER JOIN users ON days.user_id = users.id
                        INNER JOIN tasks ON days.task_id = tasks.id
                        INNER JOIN week_cards ON week_cards.days_id = days.id
                        INNER JOIN time_cards ON time_cards.week_cards_id = week_cards.id
                        WHERE
                        time_cards.inspection_review_id = $id
                        GROUP BY
                        time_cards.updated_at,
                        tasks.name,
                        time_cards.ratings,
                        time_cards.remarks,
                        users.name,
                        locations.name,
                        areas.name,
                        elements.name"
                    );

      $pdf = PDF::loadView('Company_Admin.inspection.report_pdf', compact('inspectionReport','tasks'))
      ->setPaper('a4', 'landscape');

      return $pdf->download('InspectionReport.pdf');
    }

    public function uploadReport(Request $request)
    {
      $this->validate($request,[
          'project_id' => 'required',
          'customer_id' => 'required',
          'uploadedFile' => 'required|file',
      ],
      [
          'project_id.required' => 'Select project',
          'customer_id.required' => 'Select customer',
          'uploadedFile.required' => 'Select File',
      ]
    );

      $img = $request->file('uploadedFile');
      $filename  = $img->getClientOriginalName();

      $folder = public_path('/images/Reports/');
      if(!file_exists($folder)) {
          mkdir($folder, 0755, true);
      }
      $path = $folder . $filename;
      $path = $img->move(public_path('images/Reports/'),$filename);

      $externalReport = new ExternalReport;
      $externalReport->project_id = $request->project_id;
      $externalReport->customer_id = $request->customer_id;
      $externalReport->pdf_path = $filename;
      $externalReport->company_id = Auth::user()->company_id;
      $externalReport->save();

      $externalReports = ExternalReport::all();

      return back()->withExternalReports($externalReports);
    }

    public function companyProjects()
    {
      $id = Auth::user()->id;
      $projects = Project::where('company_id','=',$id)
                  ->get();

      return response()->json([
          'projects' => $projects,
      ]);
    }

    public function projectInspectionReport(Request $request)
    {
      $project_id = $request->project_id;
      $project = Project::find($project_id);
      $project_name = $project->name;
      $project_address = $project->address;
      $inspector = $project->projectInspector->name;

      $tasks = DB::select("SELECT
                        Count(time_cards.id) AS frequency,
                        time_cards.updated_at,
                        tasks.name,
                        time_cards.ratings,
                        time_cards.remarks,
                        users.name as worker_name,
                        locations.name as Location_name,
                        areas.name as area_name,
                        elements.name as element_name
                        FROM
                        days
                        INNER JOIN areas ON days.area_id = areas.id
                        INNER JOIN elements ON days.element_id = elements.id
                        INNER JOIN locations ON days.location_id = locations.id
                        INNER JOIN users ON days.user_id = users.id
                        INNER JOIN tasks ON days.task_id = tasks.id
                        INNER JOIN week_cards ON week_cards.days_id = days.id
                        INNER JOIN time_cards ON time_cards.week_cards_id = week_cards.id
                        WHERE
                        days.project_id = $project_id
                        GROUP BY
                        time_cards.updated_at,
                        tasks.name,
                        time_cards.ratings,
                        time_cards.remarks,
                        users.name,
                        locations.name,
                        areas.name,
                        elements.name"
                    );

      return response()->json([
          'tasks' => $tasks,
          'project_name' => $project_name,
          'project_address' => $project_address,
          'inspector' => $inspector,
      ]);
    }
}
