let language = document.getElementById('languageSwitcher').value;

function languageChoosed() {
  let language = document.getElementById('languageSwitcher').value;

  axios.post(APP_URL + 'language', {
    language: language
  }).then(response => {
    window.location.reload(true);

  })
  .catch(err => console.log("Error: ", err));

}
