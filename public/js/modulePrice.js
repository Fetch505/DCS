
function getWorkerData(dataa,discounts,monthly,monthlyDiscount,moduleName){
    if ($('#'+dataa).prop("checked")!==false){
        
        if (monthly){
            if ($('#monthlyData').length){
                $('#monthlyData').click(function (){

                    $('#yearly_form').hide();
                    $('#monthly_form').show();
                    var getMonthlyValue=[];
                    for (var i =0; i < $('.checktest').length; i++) {
                        getMonthlyValue[i]=monthly;
                        break;
                    }

                    if (sessionStorage.getItem('prev1')) {
                        if (getMonthlyValue[0]==monthly) {

                            let prev=$('#tt_n').val();
                            let count=$('#cc_n').val();
                            let prevSave=$('#ssave').val();
                            let prevModuleName=$('#module_name').val();

                            let countPrev=0;
                            countPrev++;

                            let current=parseInt(monthly);
                            let full_total=current + (+prev);
                            let discount=monthlyDiscount / 100;
                            let save=current * discount;
                            save=Math.round(save);
                            discount=current - save;

                            let totalSave=(+save) + (+prevSave);
                            let total=discount + (+prev) - prevSave;
                            let count1=countPrev+(+count);
                            let moduleNames= moduleName +','+ prevModuleName ;

                            getMonthlyData(full_total,total,count1,totalSave,dataa, moduleNames);


                        $('#tt_n').val(sessionStorage.getItem('prev1'));
                        $('#ssub_total').val(sessionStorage.getItem('subTotal1'));
                        $('#ttotal_discounted_ammount').val(sessionStorage.getItem('subTotal1'));
                        $('#cc_n').val(sessionStorage.getItem('count1'));
                        $('#ssave').val(sessionStorage.getItem('prevSave1'));
                        

                        }
                      
                    }
                    else{
                        
                        let prev=$('#tt_n').val();
                        let count=$('#cc_n').val();
                        let prevSave=$('#ssave').val();
                        let subTotal=$('#ssub_total').val();
                        let prevModuleName=$('#module_name').val();

                        let countPrev=0;
                        countPrev++;

                        let current=parseInt(monthly);
                        let full_total = current + (+prev);

                        let discount = monthlyDiscount / 100;
                        let save = current * discount;
                        save = Math.round(save);
                        discount = current - save;

                        let totalSave = (+save) + (+prevSave);
                        let total = discount + (+prev) - prevSave;

                        let count1 = countPrev + (+count);
                        let moduleNames = moduleName + ',' + prevModuleName;

                        getMonthlyData(full_total, total, count1, totalSave, dataa, moduleNames);
                    }
                });
            }

            else {
               

                let prev=$('#tt_n').val();
                let count=$('#cc_n').val();
                let prevSave=$('#ssave').val();
                let prevModuleName=$('#module_name').val();
                
                let countPrev=0;
                countPrev++;

                let current=parseInt(monthly);
                let full_total=current + (+prev);
                
                let discount=monthlyDiscount / 100;
                let save=current * discount;
                save=Math.round(save);
                discount=current - save;

                let totalSave=(+save) + (+prevSave);
                let total=discount + (+prev) - prevSave;
                let count1=countPrev+(+count);
                let moduleNames= moduleName +','+ prevModuleName ;

                getMonthlyData(full_total,total,count1,totalSave,dataa, moduleNames);
            }
        }

        var prev=$('#t_n').val();
        var count=$('#c_n').val();
        var prevSave=$('#save').val();
        var prevModuleName=$('#module_name1').val();

        var countPrev=0;
        countPrev++;

        var current=parseInt($('#'+dataa).val());
        var full_total=current + (+prev);
        
        var discount=discounts / 100;
        var save=current * discount;
        save=Math.round(save);
        discount=current - save;

        var totalSave=(+save) + (+prevSave);
        var total=discount + (+prev) - prevSave;
       
        var count1=countPrev+(+count);
        var moduleNames= moduleName +','+ prevModuleName ;




        $('#t_n').val(full_total);
        $('#sub_total').val(total);
        $('#total_discounted_ammount').val(total);
        $('#c_n').val(count1);
        $('#save').val(totalSave);
        $('#module_name1').val(moduleNames);

        sessionStorage.removeItem('prev1');
        sessionStorage.removeItem('count1');
        sessionStorage.removeItem('prevSave1');
        sessionStorage.removeItem('subTotal1');


        

    }
    else if ($('#'+dataa).prop("checked")!==true){

        let prev=$('#t_n').val();
        let count=$('#c_n').val();
        let prevSave=$('#save').val();
        let prevModuleName1=$('#module_name').val();

        let countPrev=0;
        countPrev++;

        let current=parseInt($('#'+dataa).val());
        let full_total= (+prev) -current;
        let discount=discounts / 100;
        let save=current * discount;
        save=Math.round(save);
        discount=current - save;

        let totalSave=(prevSave) - (save);
        // console.log(totalSave);

        let total=(-discount) + (+prev) - prevSave;
        let count1=(+count) + (-countPrev);
        let res1 = prevModuleName1.replace(moduleName+',', "");

        $('#t_n').val(full_total);
        $('#sub_total').val(total);
        $('#total_discounted_ammount').val(total);
        $('#c_n').val(count1);
        $('#save').val(totalSave);
        $('#module_name').val(res1);


        let prev1=$('#tt_n').val();
        let count11=$('#cc_n').val();
        let prevSave1=$('#ssave').val();
        let prevModuleName=$('#module_name').val();

        let countPrev1=0;
        countPrev1++;

        let current1=parseInt(monthly);
        let full_total1= (+prev1) -current1;
        let discount1=monthlyDiscount / 100;
        let save1=current1 * discount1;
        save1=Math.round(save1);
        discount1=current1 - save1;

        let totalSave1=(prevSave1) - (save1);
        // console.log(totalSave);

        let total1=(-discount1) + (+prev1) - prevSave1;
        let count111=(+count11) + (-countPrev1);

        let res = prevModuleName.replace(moduleName+',', "");



        $('#tt_n').val(full_total1);
        $('#ssub_total').val(total1);
        $('#ttotal_discounted_ammount').val(total1);
        $('#cc_n').val(count111);
        $('#ssave').val(totalSave1);
        $('#module_name').val(res);


    }

}
$('#year').click(function(){
     $('.monthly').attr('id','monthlyData');
     $(".monthly").css({ 'background-color' : '#DCDCDC', 'color' : 'gray' });

    $('#monthlyData').removeAttr('disabled','disabled');
    $('#yearly_form').show();
    $('#monthly_form').hide();

    let prev=$('#t_n').val();
    let count=$('#c_n').val();
    let prevSave=$('#save').val();
    let subTotal=$('#sub_total').val();

    let prev1=$('#tt_n').val();
    let count1=$('#cc_n').val();
    let prevSave1=$('#ssave').val();
    let subTotal1=$('#ssub_total').val();

    sessionStorage.setItem('prev1',prev1);
    sessionStorage.setItem('count1',count1);
    sessionStorage.setItem('prevSave1',prevSave1);
    sessionStorage.setItem('subTotal1',subTotal1);

    sessionStorage.getItem('prev1');
    sessionStorage.getItem('count1');
    sessionStorage.getItem('prevSave1');
    sessionStorage.getItem('subTotal1');

    // yearly(prev1,count1,prevSave1,subTotal1);
        $('#monthly_form').trigger('reset');

    
    


    $('#t_n').val(prev);
    $('#sub_total').val(subTotal);
    $('#total_discounted_ammount').val(subTotal);
    $('#c_n').val(count);
    $('#save').val(prevSave);
     $('#year').attr('disabled','disabled');
       $('#year').css({'background-color': '#28A745','color':'white'});
});

// function yearly(prev1,count1,prevSave1,subTotal1){
 
  
//     let prev=$('#tt_n').val();
//     let count=$('#cc_n').val();
//     let prevSave=$('#ssave').val();
//     let subTotal=$('#ssub_total').val();

//     $('#tt_n').val(prev);
//     $('#ssub_total').val(subTotal);
//     $('#ttotal_discounted_ammount').val(subTotal);
//     $('#cc_n').val(count);
//     $('#ssave').val(prevSave);



  

//     // let t_d_a=$('#total_discounted_ammount').val();

//     $('#tt_n').val(prev1);
//     $('#ssub_total').val(subTotal1);
//     $('#ttotal_discounted_ammount').val(subTotal1);
//     $('#cc_n').val(count1);
//     $('#ssave').val(prevSave1);

// }

function getMonthlyData(full_total,total,count1,totalSave,dataa,moduleNames){
  
   // console.log(full_total);
   // console.log(total);
   // console.log(count1);
   // console.log(totalSave);

   
        $('#tt_n').val(full_total);
        $('#ssub_total').val(total);
        $('#ttotal_discounted_ammount').val(total);
        $('#cc_n').val(count1);
        $('#ssave').val(totalSave);
        $('#module_name').val(moduleNames);
        $('#monthlyData').attr('disabled','disabled');
          $('#monthlyData').css({'background-color': '#28A745','color':'white'});
        
        $('#monthlyData').removeAttr('id');
         $('#year').removeAttr('disabled','disabled');
            $("#year").css({ 'background-color' : '#DCDCDC', 'color' : 'gray' });
          // yearly();

  
}




function openNav() {
    document.getElementById("mySidenav").style.width = "345px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
$('#login').click(function (){
    $('#signup_form').hide();
    $('#login_form').show();
});
$('#signup').click(function (){
    $('#signup_form').show();
    $('#login_form').hide();
});

$(".monthly-save-data").click(function (event) {
    event.preventDefault();

    var str = $("#monthly_form").serialize();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/monthly",
        type: "POST",
        async: false,
        dataType: 'json',
        data: str,
        success: function (response) {
            console.log(response.success);
            if (response.success) {
                // $('.success').html(response.success);
                $("#monthly_form")[0].reset();
                $('input[type="checkbox"]').prop('checked', true);
                sessionStorage.removeItem("monthly_module_name");
                sessionStorage.removeItem("monthly_module_count");
                sessionStorage.removeItem("monthly_save",);
                sessionStorage.removeItem("monthly_total");
                sessionStorage.removeItem("monthly_sub_total");
                sessionStorage.removeItem("monthly_total_amount");

            }
            else{
                let monthly_module_name=response.fail['module_name'];
                let monthly_module_count=response.fail['module_count'];
                let monthly_save=response.fail['save'];
                let monthly_sub_total=response.fail['sub_total'];
                let monthly_total=response.fail['total'];
                let monthly_total_amount=response.fail['total_amount'];

                sessionStorage.setItem("monthly_module_name", monthly_module_name);
                sessionStorage.setItem("monthly_module_count", monthly_module_count);
                sessionStorage.setItem("monthly_save", monthly_save);
                sessionStorage.setItem("monthly_total", monthly_total);
                sessionStorage.setItem("monthly_sub_total", monthly_sub_total);
                sessionStorage.setItem("monthly_total_amount", monthly_total_amount);
            }
        },
    });
});


                $('#tt_n').val(sessionStorage.getItem('monthly_total_amount'));
                $('#cc_n').val(sessionStorage.getItem('monthly_module_count'));
                $('#ssave').val(sessionStorage.getItem('monthly_save'));
                $('#ssub_total').val(sessionStorage.getItem('monthly_sub_total'));
                $('#ttotal_discounted_ammount').val(sessionStorage.getItem('monthly_total'));
                $('#module_name').val(sessionStorage.getItem('monthly_module_name'));


                if ( $('#tt_n').val().length == 0){
                    $('input:checkbox').each(function() {
                        // Iterate over the checkboxes and set their "check" values based on the session data
                        var $el = $(this);
                        $el.prop('checked', sessionStorage[$el.prop('id')] === 'false');
                    });

                    $('input:checkbox').on('change', function() {
                        // save the individual checkbox in the session inside the `change` event,
                        // using the checkbox "id" attribute
                        var $el = $(this);
                        sessionStorage[$el.prop('id')] = $el.is(':checked');
                    });
                }else
                {
                    $('#yearly_form').hide();
                    $('#monthly_form').show();
                    // $('#yearly_form').hide();
                    $('input:checkbox').each(function() {
                        // Iterate over the checkboxes and set their "check" values based on the session data
                        var $el = $(this);
                        $el.prop('checked', sessionStorage[$el.prop('id')] === 'true');
                    });

                    $('input:checkbox').on('change', function() {
                        // save the individual checkbox in the session inside the `change` event,
                        // using the checkbox "id" attribute
                        var $el = $(this);
                        sessionStorage[$el.prop('id')] = $el.is(':checked');
                    });
                }


$(".yearly-save-data").click(function (event) {
    event.preventDefault();

    var str = $("#yearly_form").serialize();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/yearly",
        type: "POST",
        async: false,
        dataType: 'json',
        data: str,
        success: function (response) {
            if (response.success) {

                $("#yearly_form")[0].reset();
                $('input[type="checkbox"]').prop('checked', false);
                sessionStorage.removeItem("module_name");
                sessionStorage.removeItem("module_count");
                sessionStorage.removeItem("save",);
                sessionStorage.removeItem("total");
                sessionStorage.removeItem("sub_total");
                sessionStorage.removeItem("total_amount");
            }
            else{

                let module_name=response.fail['module_name1'];
                let module_count=response.fail['module_count1'];
                let save=response.fail['save1'];
                let sub_total=response.fail['sub_total1'];
                let total=response.fail['total1'];
                let total_amount=response.fail['total_amount1'];

                sessionStorage.setItem("module_name", module_name);
                sessionStorage.setItem("module_count", module_count);
                sessionStorage.setItem("save", save);
                sessionStorage.setItem("total", total);
                sessionStorage.setItem("sub_total", sub_total);
                sessionStorage.setItem("total_amount", total_amount);


            }
        },
    });
});

                $('#t_n').val(sessionStorage.getItem('total_amount'));
                $('#c_n').val(sessionStorage.getItem('module_count'));
                $('#save').val(sessionStorage.getItem('save'));
                $('#sub_total').val(sessionStorage.getItem('sub_total'));
                $('#total_discounted_ammount').val(sessionStorage.getItem('total'));
                $('#module_name1').val(sessionStorage.getItem('module_name'));


                if ( $('#t_n').val().length == 0){
                    $('input:checkbox').each(function() {
                        // Iterate over the checkboxes and set their "check" values based on the session data
                        var $el = $(this);
                        $el.prop('checked', sessionStorage[$el.prop('id')] === 'false');
                    });

                    $('input:checkbox').on('change', function() {
                        // save the individual checkbox in the session inside the `change` event,
                        // using the checkbox "id" attribute
                        var $el = $(this);
                        sessionStorage[$el.prop('id')] = $el.is(':checked');
                    });
                }else
                    {
                        $('input:checkbox').each(function() {
                            // Iterate over the checkboxes and set their "check" values based on the session data
                            var $el = $(this);
                            $el.prop('checked', sessionStorage[$el.prop('id')] === 'true');
                        });

                        $('input:checkbox').on('change', function() {
                            // save the individual checkbox in the session inside the `change` event,
                            // using the checkbox "id" attribute
                            var $el = $(this);
                            sessionStorage[$el.prop('id')] = $el.is(':checked');
                        });
                    }




