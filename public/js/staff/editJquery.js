$( window ).on( "load", function() {
  // $('#managers').hide();
  // $('#permissions').hide();
});

  $('#multi-select1').select2();
  $('#multi-select2').select2();
  $('#sup-select').select2();
  $('#man-select').select2();

  function toggleResignDateField() {
    const resignCheckbox = document.getElementById('resignCheckbox');
    const resignDateField = document.getElementById('resignDateField');

    if (resignCheckbox.checked) {
        resignDateField.style.display = 'block';
    } else {
        resignDateField.style.display = 'none';
    }
  }

  function hideShowDiv(sel) {
    console.log(sel.value);
    if (sel.value == 'supervisor') {
      $('#permissions').show();
      $('#workerType').hide();
      $('#agency').hide();
      $('#managers').show();
      $('#supervisors').hide();
    }
    else if(sel.value == 'manager') {
      $('#permissions').hide();
      $('#workerType').hide();
      $('#agency').hide();
      $('#managers').hide();
      $('#supervisors').hide();
    }
    else if(sel.value == 'user') {
      $('#permissions').hide();
      $('#workerType').show();
      $('#agency').show();
      $('#managers').hide();
      $('#supervisors').show();
    }
  }
  function changeMode() {
    let type = document.getElementById('pass').type;
    if (type === 'password') {
      document.getElementById('pass').type = 'text';
    }else {
      document.getElementById('pass').type = 'password';
    }
  }

  function editPostcode(){
    $("#postCode").prop("readonly", false);
    $("#houseNumber").prop("readonly", false);
    $("#getAddres").prop("disabled", false);
    $("#address").val('');
    $("#city").val("");
  }

  function getAddress(){
    $("#postCode").prop("readonly", true);
    $("#houseNumber").prop("readonly", true);
    $("#getAddres").prop("disabled", true);
    $("#address").val('');
    $("#city").val("");

    let post_code = $("#postCode").val();
    let house_number = $("#houseNumber").val();
    axios.post(APP_URL+`getAddressFromPostCode`,{
      'postcode' : post_code,
      'houseNumber' : house_number,
    }).then(response => {
      let city = response.data.address.city;
      let address = response.data.address.street;
      $("#address").val(address);
      $("#city").val(city);
    })
    .catch(error => {
      let selectedLanguage = $("#language").val();
      alert((selectedLanguage == 'en')?"Invalid zip code or house number" : "Ongeldige postcode of huisnummer");
    });
  }
