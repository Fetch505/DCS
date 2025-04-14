x = 1;
$(document).ready(function(){

//customer select 2
  $('#multi-select').select2({
    width: 'resolve',
    theme: "classic"
  });
  //select2 edit job starting here
  $('.floor').select2({
    width: 'resolve',
    theme: "classic"
  });

  $('.area').select2({
    width: 'resolve',
    theme: "classic"
  });

  $('.floor_type').select2({
    width: 'resolve',
    theme: "classic"
  });

  $('.element').select2({
    width: 'resolve',
    theme: "classic"
  });

  $('.worker').select2({
    width: 'resolve',
    theme: "classic"
  });

  $('.task').select2({
    width: 'resolve',
    theme: "classic"
  });
//select2 for edit job ending here

  //select2 for new job starting
  $('.Nfloor').select2({
    width: 'resolve',
    theme: "classic"
  });

  $('.Narea').select2({
    width: 'resolve',
    theme: "classic"
  });

  $('.Nfloor_type').select2({
    width: 'resolve',
    theme: "classic"
  });

  $('.Nelement').select2({
    width: 'resolve',
    theme: "classic"
  });

  $('#Nworker').select2({
    width: 'resolve',
    theme: "classic"
  });

  $('.Ntask').select2({
    width: 'resolve',
    theme: "classic"
  });
//select2 ending here



  /////////////// Time calculation starts here




      $("#sel-element").change(function(){
        // alert("element change");
        var element_hours = $(".element :selected").data("hours");
        var element_minutes = $(".element :selected").data("minutes");
        // alert("time : " + element_hours);
        var element_time = element_hours +' hr :'+ element_minutes+' mins'
        $("#time_blck").show();
        $("#old_time").val(element_time);

      });


      var element_hrs = $("#tTime").data("hr");
      var element_mints = $("#tTime").data("min");
      var total_time = (parseInt(element_hrs)*60) + parseInt(element_mints);

      function change_time() {
        var t_hrs = 0;
        var t_mins = 0;
          $("[id^=elem_hours]").each(function () {
            var hr = $(this).val();
            // alert("hr "+hr);
            t_hrs = t_hrs + parseInt(hr);
            });

          $("[id^=elem_minutes]").each(function () {
            var mn = $(this).val();
            t_mins = t_mins + parseInt(mn);
            });
             // alert("total_hr"+t_hrs);
            // alert($("#elem_hoursN0").val());
            sum_mins(t_hrs,t_mins);
      }

      function sum_mins(hr,min) {

        t_hr = hr*60;
        sum = parseInt(t_hr) + parseInt(min);
        set_time(sum);
      }

      function set_time(time) {
        // alert(time);
        total = parseInt(time);
        hours = Math.floor(total/60);
        minutes = total%60;
        x = hours + " hours : " + minutes +" minutes"
        $('#t_time').val(x);
        $("#tTime").data("hr",hours);
        $("#tTime").data("min",minutes);
      }
  //////////////Time calculation ends here


  //// editing jobs////
    $(".edit_row").click(function(event) {
      event.preventDefault();
      // if ($(this).attr("name") == 'edit') // call is from edit button
      // {

        var k = $(this).data("key");
        var row = $(this).parents("tr");

        var tbdy = $(this).parents("tr").parents("tbody");

        var key = $(this).val();
        // alert("key value in edit job = " +key);
        var id = $("#floor_id"+key).val();

        var name = $("#floor_id"+key).data("fname");
        var name = $("#floor_id"+key).data("fname");

        var area_id = $("#area_id"+key).val();

        var elem_id = $("#element_id"+key).val();
        // var elem_time = $("#elem_time"+key).val();
        var elem_hours = $("#elem_hours"+key).val();
        var elem_minutes = $("#elem_minutes"+key).val();

        var user_id = $("#user_id"+key).val();

        var task_id = $("#task_id"+key).val();

        var days = $("#days"+key).val();
        var type_name = $("#dayType"+key).val();

        var frequency = 0;
        var factor = 0;
        var floor_type_id = 0;
        // var frequency = $("#frequency"+key).val();
        // var factor = $("#factor"+key).val();
        // var floor_type_id = $("#floorType"+key).val();

//////////// this code chunk is for edit row values to be set in appropriate select boxes////////////////
        $('#sel-floor').find('option').remove();
        $('#sel-floor').append('<option >' + name + '</option>');
        $('#sel-floor').attr("disabled", true);

        $('#sel-element option').attr('selected',false);
        $('#sel-element option[value="'+elem_id+'"]').attr('selected',true);
        var time = elem_hours+" hr: "+ elem_minutes+" min";
        $("#old_time").val(time);

        $('#sel-user option').attr('selected',false);
        $('#sel-user option[value="'+user_id+'"]').attr('selected',true);

        $('#sel-task option').attr('selected',false);
        $('#sel-task option[value="'+task_id+'"]').attr('selected',true);

        // $('#sel-floorType option').attr('selected',false);
        // $('#sel-floorType option[value="'+floor_type_id+'"]').attr('selected',true);
        // $("#frequencyId").val(frequency);
        // $("#factorId").val(factor);

        var days_array = days.split(',');
        $('#sel-type').find('#typ_dyn').remove();

        if(type_name == 'daily'){
          $(".daily_days").removeClass('hide');
          $(".weekly_days").addClass('hide');
          $('#sel-type option').attr('selected',false);
          $('#sel-type option[value="0"]').attr('selected',true);

          $("#c_mon").attr('checked', false);
          $("#c_tue").attr('checked', false);
          $("#c_wed").attr('checked', false);
          $("#c_thu").attr('checked', false);
          $("#c_fri").attr('checked', false);

          if (days_array[0]==1) {
            $("#c_mon").attr('checked', true);
          }
          if (days_array[1]==1) {
            $("#c_tue").attr('checked', true);
          }
          if (days_array[2]==1) {
            $("#c_wed").attr('checked', true);
          }
          if (days_array[3]==1) {
            $("#c_thu").attr('checked', true);
          }
          if (days_array[4]==1) {
            $("#c_fri").attr('checked', true);
          }

        }
        else{
          $(".daily_days").addClass('hide');
          $(".weekly_days").removeClass('hide');
          $('#sel-type option').attr('selected',false);
          $('#sel-type option[value="1"]').attr('selected',true);

          $("#r_mon").attr('checked', false);
          $("#r_tue").attr('checked', false);
          $("#r_wed").attr('checked', false);
          $("#r_thu").attr('checked', false);
          $("#r_fri").attr('checked', false);

          if (days_array[0]==1) {
            $('#r_mon').attr('checked', true);
          }
          if (days_array[1]==1) {
            $('#r_tue').attr('checked', true);
          }
          if (days_array[2]==1) {
            $('#r_wed').attr('checked', true);
          }
          if (days_array[3]==1) {
            $('#r_thu').attr('checked', true);
          }
          if (days_array[4]==1) {
            $('#r_fri').attr('checked', true);
          }
        }

// this code chunk is for edit row values to be set in appropriate select boxes
        $.ajax({
        type: "GET",
        url: APP_URL + "/area/getAreas/"+id,
        data: {id:id},
        cache: false,
        success: function(data){
           $('#sel-area').find('option').remove();
           $('#sel-area').append('<option value="">Select Area</option>');
           for (var i = 0; i < data.length; i++) {
                   $('#sel-area').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
               }//for loop
               // $('#sel-area option').attr('selected',false);
               $('#sel-area option[value="'+area_id+'"]').attr('selected',true);
               console.log('area option added');
            }
          });//ajax call for area



////////////////////////SAVE edited job fuction start////////////////////////
        $("#edit_job").click(function (event) {
            event.preventDefault();
                var row_number = $(".row_number").val();
                // var floor = $(".floor").val();
                var area = $(".area").val();
                var worker = $(".worker").val();
                var task = $(".task").val();
                var element = $(".element").val();
                var elem_hr = $("#n_hour").val();
                var elem_min = $("#n_min").val();

                var freq = 0;
                var fact = 0;
                var floor_Type_Id = 0;
                var floor_Type_Name = 0;
                // var freq = $("#frequencyId").val();
                // var fact = $("#factorId").val();
                // var floor_Type_Id = $("#sel-floorType").val();
                // var floor_Type_Name = $("#sel-floorType :selected").data("name");

                if(area == 0 || worker == 0 || task == 0 || element == 0)
                {
                  alert('Select Floor, Area, Worker, Task, and Element ( Selecteer Vloer, Gebied, Taak, Element en WSerker)');
                  return false;
                }
// alert(area);
                if(elem_hr== 0 && elem_min== 0){

                  // var elem_hours = $("#elem_hours"+key).val();
                  // var elem_minutes = $("#elem_minutes"+key).val();
                  var elem_hours = $(".element :selected").data("hours");
                  var elem_minutes = $(".element :selected").data("minutes");
                  // alert("time : " + element_hours);
                  var time = elem_hours +' hr :'+ elem_minutes+' mins';
                  // var time = elem_hours+" hours: "+elem_minutes+" minutes";
                }
                else {

                  var elem_hours = elem_hr;
                  var elem_minutes = elem_min;
                  var time = elem_hours+" hours: "+elem_minutes+" minutes";

                }

                 $("#floorType"+key).val(area);
                 $("#floor_id"+key).val(id);
                 $("#area_id"+key).val(area);
                 $("#frequency"+key).val(freq);
                 $("#factor"+key).val(fact);
                 $("#floorType"+key).val(floor_Type_Id);
                 $("#user_id"+key).val(worker);
                 $("#element_id"+key).val(element);
                 $("#task_id"+key).val(task);
                 $("#elem_hours"+key).val(elem_hours);
                 $("#elem_minutes"+key).val(elem_minutes);
                 change_time();


                 var type = $(".clean_type").val();

////////////////changing the table row values///////////////////

                var area_name = $(".area option:selected").text();
                var worker_name = $(".worker option:selected").text();
                var element_name = $(".element option:selected").text();
                var task_name = $(".task option:selected").text();
                var type_name = $(".clean_type option:selected").text();

                var mon = '';
                var tue = '';
                var wed = '';
                var thu = '';
                var fri = '';
                var sat = '';
                var sun = '';

                if(type_name == 'Daily'){
                  if ($('#c_mon').is(":checked")) {
                    mon = "x";
                  }
                  if ($('#c_tue').is(":checked")) {
                    tue = "x";
                  }
                  if ($('#c_wed').is(":checked")) {
                    wed = "x";
                  }
                  if ($('#c_thu').is(":checked")) {
                    thu = "x";
                  }
                  if ($('#c_fri').is(":checked")) {
                    fri = "x";
                  }
                  if ($('#c_sat').is(":checked")) {
                    sat = "x";
                  }
                  if ($('#c_sun').is(":checked")) {
                    sun = "x";
                  }
                }//if type = daily
                else{
                  if ($('#r_mon').is(":checked")) {
                    mon = "x";
                  }
                  if ($('#r_tue').is(":checked")) {
                    tue = "x";
                  }
                  if ($('#r_wed').is(":checked")) {
                    wed = "x";
                  }
                  if ($('#r_thu').is(":checked")) {
                    thu = "x";
                  }
                  if ($('#r_fri').is(":checked")) {
                    fri = "x";
                  }
                  if ($('#r_sat').is(":checked")) {
                    sat = "x";
                  }
                  if ($('#r_sun').is(":checked")) {
                    sun = "x";
                  }
                }

                row.find("#r_area"+key).text(area_name);
                row.find("#td_floorType"+key).text(floor_Type_Name);
                row.find("#td_frequency"+key).text(freq);
                row.find("#td_factor"+key).text(fact);
                row.find("#td_usr"+key).text(worker_name);
                row.find("#td_elem"+key).text(element_name);
                row.find("#td_task"+key).text(task_name);
                row.find("#td_type"+key).text(type_name);
                row.find("#td_mon"+key).text(mon);
                row.find("#td_tue"+key).text(tue);
                row.find("#td_wed"+key).text(wed);
                row.find("#td_thu"+key).text(thu);
                row.find("#td_fri"+key).text(fri);
                row.find("#td_sat"+key).text(sat);
                row.find("#td_sun"+key).text(sun);
                row.find("#elem_time"+key).text(time);


                 var daily_days = [];
                 var weekly_days = '';
                 if (type == 0) {
                   $("#dayType"+key).val('daily');
                     $(".daily_days > div > input").each(function () {

                         if ($(this).is(":checked")) {
                             daily_days.push($(this).val());
                         }
                     });
                 } else {
                   $("#dayType"+key).val('weekly');
                     $(".weekly_days > div > input").each(function () {

                         if ($(this).is(":checked")) {
                             weekly_days = $(this).val();
                         }
                     });
                 }

                 var days = '';
                 if (weekly_days != '') {
                     days = weekly_days;
                 } else {
                     days = daily_days.join(",");
                 }

                 var days_array = days.split(',');

                 var day_check = [0, 0, 0, 0, 0, 0, 0];
                 days_array.forEach(function(element) {
                   if(element == 'monday') {
                     day_check[0] = 1;
                   }
                   else if(element == 'tuesday') {
                     day_check[1] = 1;
                   }
                   else if(element == 'wednesday') {
                     day_check[2] = 1;
                   }
                   else if(element == 'thursday') {
                     day_check[3] = 1;
                   }
                   else if(element == 'friday') {
                     day_check[4] = 1;
                   }
                   else if(element == 'saturday') {
                     day_check[5] = 1;
                   }
                   else if(element == 'sunday') {
                     day_check[6] = 1;
                   }
                 });
                 $("#days"+key).val(day_check);
                 key = undefined;
            });//add_jobs




            // delete k;
            //row = undefined;
            tbdy = undefined;
            key = undefined;
            // id = undefined;
            // elem_hours = undefined;
            // elem_minutes = undefined;
            name = undefined;
            //area_id = undefined;
            elem_id = undefined;
            user_id = undefined;
            task_id = undefined;
            days = undefined;
            type_name = undefined;
            days_array = undefined;
            day_check = undefined;
            daily_days = undefined;
            weekly_days = undefined;

            area_name =undefined;
            worker_name=undefined;
            element_name=undefined;
            task_name=undefined;
            type_name=undefined;
            mon=undefined;
            tue=undefined;
            wed=undefined;
            thu=undefined;
            fri=undefined;
            sat=undefined;
            sun=undefined;
            tbdy=undefined;
            k=undefined;

            // alert("K = "+ k);
            $("#n_hour").val(0);
            $("#n_min").val(0);
      var key = $(this).val();
    });

    $('#sel-floor').change(function(){
      var id = $(this).val();
      console.log($(this).val());

      $.ajax({
      type: "GET",
      url: APP_URL + "/area/getAreas/"+id,
      data: {id:id},
      cache: false,
      success: function(data){
         console.log(data);
         $('#sel-area').find('option').remove()
         $('#sel-area').append('<option value="">Select Area</option>');
         for (var i = 0; i < data.length; i++) {
           console.log(data[i].id);
                 $('#sel-area').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
             }
      }
    });
  });// Floor select function

  $(".clean_type").change(function () {
     var type = $(this).val();
     if (type == '0')  {
         $(".daily_days").removeClass('hide');
         $(".weekly_days").addClass('hide');
     } else {
         $(".daily_days").addClass('hide');
         $(".weekly_days").removeClass('hide');
     }
  });
/////////////////////////edit job fuction finish///////////////////////////


///////////////////////////////NEW JOB////////////////////


$("#N_close_job").click(function(event) {
  event.preventDefault();
  console.log('clear mmodal funct');
});

function new_job_total_time(nElem_hrs,nElem_mins){
  var N_total_hr = $("#elem_hoursN").val();
  var N_total_min = $("#elem_minutesN").val();
  var t_hr = parseInt(N_total_hr) + parseInt(nElem_hrs);
  var t_mn = parseInt(N_total_min) + parseInt(nElem_mins);
  $("#elem_hoursN").val(t_hr);
  $("#elem_minutesN").val(t_mn);
}

/////
    var tbdy;
    var key;
    var id;
    var html;
    var inputs;
    var actions;
    var nElem_hrs;
    var nElem_mins;
    var element_Time;
    var elem_hr;
    var elem_min;
    var id;
    var elem_hours;
    var elem_minutes;
    var name;
    var area_id;
    var elem_id;
    var user_id;
    var task_id;
    var days;
    var type_name;
    var days_array;
    var day_check;
    var daily_days;
    var weekly_days;

    var area_name;
    var worker_name;
    var element_name;
    var task_name;
    var type_name;
    var mon;
    var tue;
    var wed;
    var thu;
    var fri;
    var sat;
    var sun;
    var tbdy;
    var k;
////////
   var count = 0;
   // $("#new_job").unbind('click');
  $("#new_job").click(function(event) {
      event.preventDefault();
      console.log('add new job');
      // $("#dyn_label").show( "slow" );
      // $("#dyn_table").show( "slow" );
    });

      /////////////

    $("#N_add_job").click(function (event) {
        event.preventDefault();
        console.log('add job clicked');
        $("#dyn_label").show( "slow" );
        $("#dyn_table").show( "slow" );

            var row_number = $(".row_number").val();
            var floor = $(".Nfloor").val();
            var area = $(".Narea").val();
            var worker = $(".Nworker").val();
            var task = $(".Ntask").val();
            var element = $(".Nelement").val();
            var elem_hr = $("#N_hour").val();
            var elem_min = $("#N_min").val();
            var frequency = 0;
            var factor = 0;
            var floorType = 0;
            // var frequency = document.getElementById('NfrequencyId').value;
            // var factor = document.getElementById('NfactorId').value;
            // var floorType = $(".Nfloor_type").val();

            if(floor == 0 || area == 0 || worker == 0 || task == 0 || element == 0)
            {
                alert('Select Floor, Area, Worker, Task, and Element ( Selecteer Vloer, Gebied, Taak, Element en WSerker)');
                return false;
             }

            if(elem_hr== 0 && elem_min== 0){
              var nElem_hrs = $(".Nelement :selected").data("hours");
              var nElem_mins = $(".Nelement :selected").data("minutes");
              new_job_total_time(nElem_hrs,nElem_mins);
              var element_Time = nElem_hrs +' hr :'+ nElem_mins+' mins';
            }
            else {
              var nElem_hrs = elem_hr;
              var nElem_mins = elem_min;
              new_job_total_time(nElem_hrs,nElem_mins);
              var element_Time = nElem_hrs+" hours: "+nElem_mins+" minutes";
            }



             var floor_arr = floor.split("|");
             var floor_id = floor_arr[0];
             var floor_name = floor_arr[1];

             var area_arr = area.split("|");
             var area_id = area_arr[0];
             var area_name = area_arr[1];

            var floorType_arr = 0;
            var floorType_id = 0;
            var floorType_name = 0;
            // var floorType_arr = floorType.split("|");
            // var floorType_id = floorType_arr[0];
            // var floorType_name = floorType_arr[1];

             var worker_arr = worker.split("|");
             var worker_id = worker_arr[0];
             var worker_name = worker_arr[1];

             var task_arr = task.split("|");
             var task_id = task_arr[0];
             var task_name = task_arr[1];

             var element_arr = element.split("|");
             var element_id = element_arr[0];
             var element_name = element_arr[1];

             var type = $(".Nclean_type").val();
             $("#NdayType"+key).val(type);

             var daily_days = [];
             var weekly_days = '';
             if (type == 0) {

                 $(".Ndaily_days > div > input").each(function () {
                   type = 'daily';
                     if ($(this).is(":checked")) {
                         daily_days.push($(this).val());
                     }
                 });
             } else {

                 $(".Nweekly_days > div > input").each(function () {
                      type = 'weekly';
                     if ($(this).is(":checked")) {
                         weekly_days = $(this).val();
                     }
                 });
             }

             var days = '';
             if (weekly_days != '') {
                 days = weekly_days;
             } else {
                 days = daily_days.join(",");
             }

             var days_array = days.split(',');

             var day_check = [0, 0, 0, 0, 0, 0, 0];
             var days = ['','','','','','',''];
             days_array.forEach(function(element) {

               if(element == 'monday') {
                 day_check[0] = 1;
                 days[0] ='x';
               }
                if(element == 'tuesday') {
                 day_check[1] = 1;
                  days[1] ='x';
               }
                if(element == 'wednesday') {
                 day_check[2] = 1;
                  days[2] ='x';
               }
                if(element == 'thursday') {
                 day_check[3] = 1;
                  days[3] ='x';
               }
                if(element == 'friday') {
                 day_check[4] = 1;
                  days[4] ='x';
               }
                if(element == 'saturday') {
                 day_check[5] = 1;
                  days[5] ='x';
               }
                if(element == 'sunday') {
                 day_check[6] = 1;
                  days[6] ='x';
               }
             });

            $(".tasks>input").val('');

             var inputs =
                 '<input type="hidden" class="floor_id" name="Nfloor_id' + count + '" value="' + floor_id + '">'
                 + '<input type="hidden" class="area_id" name="Narea_id' + count + '" value="' + area_id + '">'
                 + '<input type="hidden" class="NfloorType_id" name="NfloorType_id' + count + '" value="' + floorType_id + '">'
                 + '<input type="hidden" class="Nfrequency" name="Nfrequency' + count + '" value="' + frequency + '">'
                 + '<input type="hidden" class="Nfactor" name="Nfactor' + count + '" value="' + factor + '">'
                 + '<input type="hidden" class="element_id" name="Nelement_id' + count + '" value="' + element_id + '">'+ '<input type="hidden" class="elem_hoursN" name="elem_hoursN' + count + '" value="' + nElem_hrs + '">'+ '<input type="hidden" class="elem_minutesN" name="elem_minutesN' + count + '" value="' + nElem_mins + '">'
                 + '<input type="hidden" class="worker_id" name="Nuser_id' + count + '" value="' + worker_id + '">' +
                 '<input type="hidden" class="task_id" name="Ntask_id' + count + '" value="' + task_id + '">' +
                 '<input type="hidden" class="days" name="Ndays' + count + '" value="' + day_check + '">' +
                 '<input type="hidden" class="type" name="NdayType' + count + '" value="' + type + '">';

             var actions = '<td class="grid_row"><a href="javascript:void(0);" class="remove"><i class="fa fa-trash"></i></a> </td>';

             var html = '<tr><td class="flo">' + floor_name + '<td class="are">' + area_name + '<td hidden class="floorType_name">' + floorType_name + '<td hidden class="frequency">' + frequency +'<td hidden class="factor">' + factor +  '<td class="work">' + worker_name + '<td class="elem">' + element_name +  '</td><td class="elem">' + element_Time +'</td><td class="t_name">'+ task_name + '</td><td class="t_type">'+ type + '</td><td class="mon">'+ days[0] + '</td><td class="tue">'+ days[1]+ '</td><td class="wed">'+ days[2] + '</td><td class="thur">'+ days[3]  + '</td><td class="fri">'+ days[4] + '</td><td class="sat">'+ days[5] + '</td><td class="sun">'+ days[6] + '</td></tr>';

             if (worker_name != '' && floor_name != '' && area_name != '' && element_name != '' && task_name != '' && days != '')
                 $(".days_tbl").removeClass('hide');

             $(".tbl_body").append(html);
             $(".tbl_body").append(inputs);

             count++;

             $(".Nfloor"+key).val();
             $(".Narea"+key).val();
             $(".Nworker"+key).val();
             $(".Ntask"+key).val();
             $(".Nelement"+key).val();
             change_time();
             key = undefined;


             var key = $(this).val();
             // document.getElementById('NfrequencyId').value='';
             // document.getElementById('NfactorId').value='';
              // $(".Nfloor").val(null).trigger('change');
              // $(".Nfloor_type").val(null).trigger('change');
              // $(".Nworker").val(null).trigger('change');
              $(".Ntask").val(null).trigger('change');
              $(".Nelement").val(null).trigger('change');
              $('.N').prop("checked", "").end();
              $('.N').prop("checked", "").end();
              // $('Narea').find('option').remove();
              // $('Narea').append('<option value="">Please First Select Floor</option>');
              $("#Nold_time").val('');
              $("#N_hour").val('');
              $("#N_min").val('');


        });//add New jobs

      //////////

      $("#Nelem_select").change(function(){
        var element_hours = $(".Nelement :selected").data("hours");
        var element_minutes = $(".Nelement :selected").data("minutes");
        var element_time = element_hours +' hr :'+ element_minutes+' mins'
        $("#Ntime_blck").show();
        $("#Nold_time").val(element_time);
      });

      $('#Nsel-floor').change(function(){
        var N_floor = $(this).val();
        var floor_arr = N_floor.split("|");
        var id = floor_arr[0];
        var floor_name = floor_arr[1];

        $.ajax({
        type: "GET",
        url: APP_URL + "/area/getAreas/"+id,
        data: {id:id},
        cache: false,
        success: function(data){
           $('#Nsel-area').find('option').remove()
           $('#Nsel-area').append('<option value="">Select Area</option>');
           for (var i = 0; i < data.length; i++) {
                   $('#Nsel-area').append('<option value="' + data[i].id +'|'+ data[i].name + '">' + data[i].name + '</option>');
               }
        }
      });

    });// New job Floor select function

    //////////////NEw JOB clean types
    $(".Nclean_type").change(function () {
       var type = $(this).val();
       if (type == '0')  {
           $(".Ndaily_days").removeClass('hide');
           $(".Nweekly_days").addClass('hide');
       } else {
           $(".Ndaily_days").addClass('hide');
           $(".Nweekly_days").removeClass('hide');
       }
    });
    ////////////////////////New Jobs End here

  });//document ready ends here
