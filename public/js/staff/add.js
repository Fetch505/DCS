Vue.component('vue-phone-number-input', window.VuePhoneNumberInput);
new Vue({
  'el' : '#app',
  data:{
    countries:
    {
      'AF': 'Afghanistan',
      'AX': 'Aland Islands',
      'AL': 'Albania',
      'DZ': 'Algeria',
      'AS': 'American Samoa',
      'AD': 'Andorra',
      'AO': 'Angola',
      'AI': 'Anguilla',
      'AQ': 'Antarctica',
      'AG': 'Antigua And Barbuda',
      'AR': 'Argentina',
      'AM': 'Armenia',
      'AW': 'Aruba',
      'AU': 'Australia',
      'AT': 'Austria',
      'AZ': 'Azerbaijan',
      'BS': 'Bahamas',
      'BH': 'Bahrain',
      'BD': 'Bangladesh',
      'BB': 'Barbados',
      'BY': 'Belarus',
      'BE': 'Belgium',
      'BZ': 'Belize',
      'BJ': 'Benin',
      'BM': 'Bermuda',
      'BT': 'Bhutan',
      'BO': 'Bolivia',
      'BA': 'Bosnia And Herzegovina',
      'BW': 'Botswana',
      'BV': 'Bouvet Island',
      'BR': 'Brazil',
      'IO': 'British Indian Ocean Territory',
      'BN': 'Brunei Darussalam',
      'BG': 'Bulgaria',
      'BF': 'Burkina Faso',
      'BI': 'Burundi',
      'KH': 'Cambodia',
      'CM': 'Cameroon',
      'CA': 'Canada',
      'CV': 'Cape Verde',
      'KY': 'Cayman Islands',
      'CF': 'Central African Republic',
      'TD': 'Chad',
      'CL': 'Chile',
      'CN': 'China',
      'CX': 'Christmas Island',
      'CC': 'Cocos (Keeling) Islands',
      'CO': 'Colombia',
      'KM': 'Comoros',
      'CG': 'Congo',
      'CD': 'Congo, Democratic Republic',
      'CK': 'Cook Islands',
      'CR': 'Costa Rica',
      'CI': 'Cote D\'Ivoire',
      'HR': 'Croatia',
      'CU': 'Cuba',
      'CY': 'Cyprus',
      'CZ': 'Czech Republic',
      'DK': 'Denmark',
      'DJ': 'Djibouti',
      'DM': 'Dominica',
      'DO': 'Dominican Republic',
      'EC': 'Ecuador',
      'EG': 'Egypt',
      'SV': 'El Salvador',
      'GQ': 'Equatorial Guinea',
      'ER': 'Eritrea',
      'EE': 'Estonia',
      'ET': 'Ethiopia',
      'FK': 'Falkland Islands (Malvinas)',
      'FO': 'Faroe Islands',
      'FJ': 'Fiji',
      'FI': 'Finland',
      'FR': 'France',
      'GF': 'French Guiana',
      'PF': 'French Polynesia',
      'TF': 'French Southern Territories',
      'GA': 'Gabon',
      'GM': 'Gambia',
      'GE': 'Georgia',
      'DE': 'Germany',
      'GH': 'Ghana',
      'GI': 'Gibraltar',
      'GR': 'Greece',
      'GL': 'Greenland',
      'GD': 'Grenada',
      'GP': 'Guadeloupe',
      'GU': 'Guam',
      'GT': 'Guatemala',
      'GG': 'Guernsey',
      'GN': 'Guinea',
      'GW': 'Guinea-Bissau',
      'GY': 'Guyana',
      'HT': 'Haiti',
      'HM': 'Heard Island & Mcdonald Islands',
      'VA': 'Holy See (Vatican City State)',
      'HN': 'Honduras',
      'HK': 'Hong Kong',
      'HU': 'Hungary',
      'IS': 'Iceland',
      'IN': 'India',
      'ID': 'Indonesia',
      'IR': 'Iran, Islamic Republic Of',
      'IQ': 'Iraq',
      'IE': 'Ireland',
      'IM': 'Isle Of Man',
      'IL': 'Israel',
      'IT': 'Italy',
      'JM': 'Jamaica',
      'JP': 'Japan',
      'JE': 'Jersey',
      'JO': 'Jordan',
      'KZ': 'Kazakhstan',
      'KE': 'Kenya',
      'KI': 'Kiribati',
      'KR': 'Korea',
      'KW': 'Kuwait',
      'KG': 'Kyrgyzstan',
      'LA': 'Lao People\'s Democratic Republic',
      'LV': 'Latvia',
      'LB': 'Lebanon',
      'LS': 'Lesotho',
      'LR': 'Liberia',
      'LY': 'Libyan Arab Jamahiriya',
      'LI': 'Liechtenstein',
      'LT': 'Lithuania',
      'LU': 'Luxembourg',
      'MO': 'Macao',
      'MK': 'Macedonia',
      'MG': 'Madagascar',
      'MW': 'Malawi',
      'MY': 'Malaysia',
      'MV': 'Maldives',
      'ML': 'Mali',
      'MT': 'Malta',
      'MH': 'Marshall Islands',
      'MQ': 'Martinique',
      'MR': 'Mauritania',
      'MU': 'Mauritius',
      'YT': 'Mayotte',
      'MX': 'Mexico',
      'FM': 'Micronesia, Federated States Of',
      'MD': 'Moldova',
      'MC': 'Monaco',
      'MN': 'Mongolia',
      'ME': 'Montenegro',
      'MS': 'Montserrat',
      'MA': 'Morocco',
      'MZ': 'Mozambique',
      'MM': 'Myanmar',
      'NA': 'Namibia',
      'NR': 'Nauru',
      'NP': 'Nepal',
      'NL': 'Netherlands',
      'AN': 'Netherlands Antilles',
      'NC': 'New Caledonia',
      'NZ': 'New Zealand',
      'NI': 'Nicaragua',
      'NE': 'Niger',
      'NG': 'Nigeria',
      'NU': 'Niue',
      'NF': 'Norfolk Island',
      'MP': 'Northern Mariana Islands',
      'NO': 'Norway',
      'OM': 'Oman',
      'PK': 'Pakistan',
      'PW': 'Palau',
      'PS': 'Palestinian Territory, Occupied',
      'PA': 'Panama',
      'PG': 'Papua New Guinea',
      'PY': 'Paraguay',
      'PE': 'Peru',
      'PH': 'Philippines',
      'PN': 'Pitcairn',
      'PL': 'Poland',
      'PT': 'Portugal',
      'PR': 'Puerto Rico',
      'QA': 'Qatar',
      'RE': 'Reunion',
      'RO': 'Romania',
      'RU': 'Russian Federation',
      'RW': 'Rwanda',
      'BL': 'Saint Barthelemy',
      'SH': 'Saint Helena',
      'KN': 'Saint Kitts And Nevis',
      'LC': 'Saint Lucia',
      'MF': 'Saint Martin',
      'PM': 'Saint Pierre And Miquelon',
      'VC': 'Saint Vincent And Grenadines',
      'WS': 'Samoa',
      'SM': 'San Marino',
      'ST': 'Sao Tome And Principe',
      'SA': 'Saudi Arabia',
      'SN': 'Senegal',
      'RS': 'Serbia',
      'SC': 'Seychelles',
      'SL': 'Sierra Leone',
      'SG': 'Singapore',
      'SK': 'Slovakia',
      'SI': 'Slovenia',
      'SB': 'Solomon Islands',
      'SO': 'Somalia',
      'ZA': 'South Africa',
      'GS': 'South Georgia And Sandwich Isl.',
      'ES': 'Spain',
      'LK': 'Sri Lanka',
      'SD': 'Sudan',
      'SR': 'Suriname',
      'SJ': 'Svalbard And Jan Mayen',
      'SZ': 'Swaziland',
      'SE': 'Sweden',
      'CH': 'Switzerland',
      'SY': 'Syrian Arab Republic',
      'TW': 'Taiwan',
      'TJ': 'Tajikistan',
      'TZ': 'Tanzania',
      'TH': 'Thailand',
      'TL': 'Timor-Leste',
      'TG': 'Togo',
      'TK': 'Tokelau',
      'TO': 'Tonga',
      'TT': 'Trinidad And Tobago',
      'TN': 'Tunisia',
      'TR': 'Turkey',
      'TM': 'Turkmenistan',
      'TC': 'Turks And Caicos Islands',
      'TV': 'Tuvalu',
      'UG': 'Uganda',
      'UA': 'Ukraine',
      'AE': 'United Arab Emirates',
      'GB': 'United Kingdom',
      'US': 'United States',
      'UM': 'United States Outlying Islands',
      'UY': 'Uruguay',
      'UZ': 'Uzbekistan',
      'VU': 'Vanuatu',
      'VE': 'Venezuela',
      'VN': 'Viet Nam',
      'VG': 'Virgin Islands, British',
      'VI': 'Virgin Islands, U.S.',
      'WF': 'Wallis And Futuna',
      'EH': 'Western Sahara',
      'YE': 'Yemen',
      'ZM': 'Zambia',
      'ZW': 'Zimbabwe',
    },
    phoneDetails:null,
    name:'',
    gender:'',
    visa_expiry_date:'',
    passport_expiry_date:'',
    health_card_expiry_date:'',
    employee_code:'',
    email:'',
    city:'',
    country:'',
    address:'',
    postcode: '',
    houseNumber: '',
    phone:'',
    role:'worker',
    pass:'',
    passwordField:'password',
    eyeIcon:'fa fa-eye',
    emailError:false,
    agency_id:'',
    shift_id:'',
    manager_id:'',
    supervisor_id:'',
    worker_type_id:'',
    checkedPermissions:[],
    errors:[],
    selectedLanguage : 'en',
  },
  methods:{

    getAddress(){
      this.city= '';
      this.address= '';
      axios.post(APP_URL+`getAddressFromPostCode`,{
        'postcode' : this.postcode,
        'houseNumber' : this.houseNumber,
      }).then(response=>{
        console.log('response:',response.data);
        this.city = response.data.address.city;
        this.address = response.data.address.street;
      })
      .catch(error=>{
        console.log('error:',error);
        this.$swal("Error!", (this.selectedLanguage == 'en')?"Invalid zip code or house number" : "Ongeldige postcode of huisnummer", "error");
      })
    },//getAddress ends here

    onUpdate(payload){
      this.phoneDetails = payload;
      this.country = this.countries[payload.countryCode];
   },

   chageVisibility(){
     if (this.passwordField === 'password') {
       this.passwordField = 'text';
       this.eyeIcon = 'fa fa-eye-slash';
     }else {
       this.passwordField = 'password';
       this.eyeIcon = 'fa fa-eye';
     }
   }, // chageVisibility ends here

    saveDetails(){
      if (this.phoneDetails && !this.phoneDetails.isValid){

        this.$swal("Sorry!", (this.selectedLanguage == 'en')?"Please add valid phone number":"Voeg een geldig telefoonnummer toe", "error");
        return null;
      }

        axios.post(APP_URL + `staff`,{
          'name' : this.name,
          'gender' : this.gender,
          'visa_expiry_date' : this.visa_expiry_date,
          'passport_expiry_date' : this.passport_expiry_date,
          'health_card_expiry_date' : this.health_card_expiry_date,
          'employee_code' : this.employee_code,
          'email' : this.email,
          'phone': this.phoneDetails? this.phoneDetails.formattedNumber:null,
          'address' : this.address,
          'postcode' : this.postcode,
          'houseNumber' : this.houseNumber,
          'city' : this.city,
          'country' : this.country,
          'role' : this.role,
          'agency_id' : this.agency_id,
          'shift_id' : this.shift_id,
          'manager_id' : this.manager_id,
          'supervisor_id' : this.supervisor_id,
          'worker_type_id' : this.worker_type_id,
          'password' : this.pass,
          'permissions' : this.checkedPermissions,
        })
        .then(response => {
          console.log('response',response);
          this.$swal("Good job!", (this.selectedLanguage == 'en')?"Staff added Successfuly":"Personeel succesvol toegevoegd", "success");
          this.name = '';
          this.gender = '';
          this.visa_expiry_date = '';
          this.passport_expiry_date = '';
          this.health_card_expiry_date = '';
          this.employee_code = '';
          this.email = '';
          this.phoneDetails.formattedNumber = '';
          this.address = '';
          this.postcode = '';
          this.houseNumber = '';
          this.city = '';
          this.role = '';
          this.agency_id = '';
          this.shift_id = '';
          this.manager_id = '';
          this.supervisor_id = '';
          this.worker_type_id = '';
          this.pass = '';
        })
        .catch(error => {
          this.errors = error.response.data.errors;
          this.$swal("Ooops!", (this.selectedLanguage == 'en')?"Add required data":"Vereiste gegevens toevoegen", "error");
          console.log(error);
        });

    }, //updateDetails end here
  },
  mounted(){
    this.country = this.countries.NL;
    this.selectedLanguage = this.$refs.language.value;
  },
})
