<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title></title>
  </head>
  <body>
    <div class="">
      <h2>Digital Cleaning System</h2>
    </div>
    <div class="col-lg-12">
      <div class="panel panel-info">

        <div class="panel-heading">
          @lang('Company_Admin/dashboard.Staff') @lang('Company_Admin/dashboard.Details')
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <!-- <div class="col-md-8 col-md-offset-4"> -->
          <div class="inline">
            <label for="name">@lang('Company_Admin/dashboard.Staff')  @lang('Company_Admin/dashboard.Name') :</label>
            <span style="position: absolute; left: 150px;">{{$user->name}}</span>
          </div>
          <br>
          <div class="inline">
            <label for="name">@lang('common.Associated agency'):</label>
            <span style="position: absolute; left: 150px;">{{ ($user->employment_agency_id) ? $user->agency->name: $user->companyName['name'] }}</span>
          </div>
          <br>
          <div class="inline">
            <label for="name">@lang('common.Worker type'):</label>
            <span style="position: absolute; left: 150px;">{{ ($user->worker_type_id) ? $user->worker_type->name: ''}}</span>
          </div>
          <br>
          <div class="inline">
            <label for="name">@lang('Company_Admin/dashboard.Role'):</label>
            <span style="position: absolute; left: 150px;">{{$user->role->name}}</span>
          </div>
          <br>
          <div class="inline">
            <label for="name">@lang('Company_Admin/dashboard.Email'):</label>
            <span style="position: absolute; left: 150px;">{{$user->email}}</span>
          </div>
          <div class="inline">
            @if(Auth::user()->companyAllowedSickLeaves(Auth::user()->id))
              <label for="name">@lang('Company_Admin/dashboard.Permissions Assigned'):</label>
              <ul style="padding-left:150px; list-style-type:square">
                @foreach ($user->permissions as $permission)
                  <li> <i>{{$permission->name}}</i> </li>
                @endforeach
              </ul>
            @endif
          </div>          
          </div> <!-- panel body -->
        </div><!-- panel info -->

</html>
