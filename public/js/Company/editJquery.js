  function changeMode() {
    let type = document.getElementById('pass').type;
    if (type === 'password') {
      document.getElementById('pass').type = 'text';
    }else {
      document.getElementById('pass').type = 'password';
    }
  }

  function editPostcode(){
    console.log('hello edit');
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
