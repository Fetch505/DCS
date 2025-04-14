



    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper');
     //Input field wrapper

     //New input field html
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
             //Increment field counter

             console.log("X = "+x);
             var fieldHTML = '<div><input type="hidden" name="lat' + x + '" id="lat' + x + '"><input type="hidden" name="lng' + x + '" id="lng' + x + '"><input type="hidden" name="location' + x + '" id="location' + x + '"><input id="searchId' + x + '" class="controls " placeholder="" type="text"><a href="javascript:void(0);" class="btn btn-danger remove_button">-</a></div>';
            $(wrapper).append(fieldHTML); //Add field html
            var location = $('#pac-input').val();
            console.log("location : " + location);


            console.log("searchId : " + '#searchId'+x);
            $('#searchId'+x).val(location);
            $('#pac-input').val("");
            var lat = $('#lat0').val();
            var lng = $('#lng0').val();
            var loc = $('#location0').val();

            $('#lat'+key).val(lat);
            $('#lng'+key).val(lng);
            $('#location'+key).val(loc);
            x++;
        }
    });//add button click function ends

  // $(".remove_button").click(function(e){
  //   console.log("remove me");
  //   e.preventDefault();
  //   $(this).parent('div').remove();
  // });

    $(wrapper).on('click', '.remove_button', function(e){

        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });



function hideField(id)
{
  $('#removeField'+id).css('display', 'none');
  // console.log('#removeField'+id);
    $.ajax({
    type: "GET",
    url: "/project/removeLocation/"+id,
    data: {id:id},
    cache: false,
    success: function(data){
       $("#resultarea").text(data);
        }
    });
}
