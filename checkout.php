<form name="check-out" action="<?php echo osc_current_web_theme_url('includes/express-checkout.php') ?>" method="post">
	<button class="btn btn-success" type="submit" name="check-out">Paypal Express Checkout</button>    
</form>
<form name="check-out" action="<?php echo osc_current_web_theme_url('includes/direct-payment.php') ?>" method="post">
	<div class="form-group">
    	<label for="fname">First Name:</label>
    	<input type="text" class="form-control" id="fname">
  	</div>

	<div class="form-group">
    	<label for="lname">Last Name:</label>
    	<input type="text" class="form-control" id="lname">
  	</div>
  	<div class="form-group">
    	<label for="street">Streey:</label>
    	<input type="text" class="form-control" id="street">
  	</div>
	<div class="form-group">
    	<label for="city">City:</label>
    	<input type="text" class="form-control" id="city">
  	</div>
  	<div class="form-group">
	  	<select class="form-control" name="VisaType">
	  		<option value="">Please select Credit Card type.</option>
	  		<option value="visa">VISA</option>
	  		<option value="master">Master Card</option>
	  	</select>	
 	</div>
  	<select class="form-control" name="expmonth">
  		<option value"01">01</option>
  		<option value"02">02</option>
  		<option value"03">03</option>
  		<option value"04">04</option>
  		<option value"05">05</option>
  		<option value"06">06</option>
  		<option value"07">07</option>
  		<option value"08">08</option>
  		<option value"09">09</option>
  		<option value"10">10</option>
  		<option value"11">11</option>
  		<option value"12">12</option>
  	</select>
  	<select class="form-control" name="expyear">
  		<option value"2015">2015</option>
  		<option value"2016">2016</option>
  		<option value"2017">2017</option>
  		<option value"2018">2018</option>
  		<option value"2019">2019</option>
  		<option value"2020">2020</option>
  		<option value"2021">2021</option>
  		<option value"2022">2022</option>
  		<option value"2023">2023</option>
  		<option value"2024">2024</option>
  		<option value"2025">2025</option>
  	</select>
	<select class="form-control" name='ContactCountry'>
		<option value="">Please select a country</option>
		<option value="AX">ÅLAND ISLANDS</option><br />
		<option value="AL">ALBANIA</option><br />
		<option value="DZ">ALGERIA </option><br />
		<option value="AS">AMERICAN SAMOA</option><br />
		<option value="AD">ANDORRA</option><br />
		<option value="AI">ANGUILLA</option><br />
		<option value="AQ">ANTARCTICA </option><br />
		<option value="AG">ANTIGUA AND BARBUDA</option><br />
		<option value="AR">ARGENTINA</option><br />
		<option value="AM">ARMENIA</option><br />
		<option value="AW">ARUBA</option><br />
		<option value="AU">AUSTRALIA</option><br />
		<option value="AT">AUSTRIA</option><br />
		<option value="AZ">AZERBAIJAN</option><br />
		<option value="BS">BAHAMAS</option><br />
		<option value="BH">BAHRAIN</option><br />
		<option value="BD">BANGLADESH</option><br />
		<option value="BB">BARBADOS</option><br />
		<option value="BE">BELGIUM</option><br />
		<option value="BZ">BELIZE</option><br />
		<option value="BJ">BENIN</option><br />
		<option value="BM">BERMUDA</option><br />
		<option value="BT">BHUTAN</option><br />
		<option value="BA">BOSNIA-HERZEGOVINA</option><br />
		<option value="BW">BOTSWANA</option><br />
		<option value="BV">BOUVET ISLAND </option><br />
		<option value="BR">BRAZIL</option><br />
		<option value="IO">BRITISH INDIAN OCEAN TERRITORY </option><br />
		<option value="BN">BRUNEI DARUSSALAM</option><br />
		<option value="BG">BULGARIA</option><br />
		<option value="BF">BURKINA FASO</option><br />
		<option value="CA">CANADA</option><br />
		<option value="CV">CAPE VERDE</option><br />
		<option value="KY">CAYMAN ISLANDS</option><br />
		<option value="CF">CENTRAL AFRICAN REPUBLIC </option><br />
		<option value="CL">CHILE</option><br />
		<option value="CN">CHINA</option><br />
		<option value="CX">CHRISTMAS ISLAND </option><br />
		<option value="CC">COCOS (KEELING) ISLANDS</option><br />
		<option value="CO">COLOMBIA</option><br />
		<option value="CK">COOK ISLANDS</option><br />
		<option value="CR">COSTA RICA</option><br />
		<option value="CY">CYPRUS</option><br />
		<option value="CZ">CZECH REPUBLIC</option><br />
		<option value="DK">DENMARK</option><br />
		<option value="DJ">DJIBOUTI</option><br />
		<option value="DM">DOMINICA</option><br />
		<option value="DO">DOMINICAN REPUBLIC</option><br />
		<option value="EC">ECUADOR</option><br />
		<option value="EG">EGYPT</option><br />
		<option value="SV">EL SALVADOR</option><br />
		<option value="EE">ESTONIA</option><br />
		<option value="FK">FALKLAND ISLANDS (MALVINAS)</option><br />
		<option value="FO">FAROE ISLANDS</option><br />
		<option value="FJ">FIJI</option><br />
		<option value="FI">FINLAND</option><br />
		<option value="FR">FRANCE</option><br />
		<option value="GF">FRENCH GUIANA</option><br />
		<option value="PF">FRENCH POLYNESIA</option><br />
		<option value="TF">FRENCH SOUTHERN TERRITORIES</option><br />
		<option value="GA">GABON</option><br />
		<option value="GM">GAMBIA</option><br />
		<option value="GE">GEORGIA</option><br />
		<option value="DE">GERMANY</option><br />
		<option value="GH">GHANA</option><br />
		<option value="GI">GIBRALTAR</option><br />
		<option value="GR">GREECE</option><br />
		<option value="GL">GREENLAND</option><br />
		<option value="GD">GRENADA</option><br />
		<option value="GP">GUADELOUPE</option><br />
		<option value="GU">GUAM</option><br />
		<option value="CG">GUERNSEY</option><br />
		<option value="GY">GUYANA</option><br />
		<option value="HM">HEARD ISLAND AND MCDONALD ISLANDS </option><br />
		<option value="VA">HOLY SEE (VATICAN CITY STATE)</option><br />
		<option value="HN">HONDURAS</option><br />
		<option value="HK">HONG KONG</option><br />
		<option value="HU">HUNGARY</option><br />
		<option value="IS">ICELAND</option><br />
		<option value="IN">INDIA</option><br />
		<option value="ID">INDONESIA</option><br />
		<option value="IE">IRELAND</option><br />
		<option value="IM">ISLE OF MAN</option><br />
		<option value="IL">ISRAEL</option><br />
		<option value="IT">ITALY</option><br />
		<option value="JM">JAMAICA</option><br />
		<option value="JP">JAPAN</option><br />
		<option value="JE">JERSEY</option><br />
		<option value="JO">JORDAN</option><br />
		<option value="KZ">KAZAKHSTAN</option><br />
		<option value="KI">KIRIBATI</option><br />
		<option value="KR">KOREA, REPUBLIC OF</option><br />
		<option value="KW">KUWAIT</option><br />
		<option value="KG">KYRGYZSTAN</option><br />
		<option value="LV">LATVIA</option><br />
		<option value="LS">LESOTHO</option><br />
		<option value="LI">LIECHTENSTEIN</option><br />
		<option value="LT">LITHUANIA</option><br />
		<option value="LU">LUXEMBOURG</option><br />
		<option value="MO">MACAO</option><br />
		<option value="MK">MACEDONIA</option><br />
		<option value="MG">MADAGASCAR</option><br />
		<option value="MW">MALAWI</option><br />
		<option value="MY">MALAYSIA</option><br />
		<option value="MT">MALTA</option><br />
		<option value="MH">MARSHALL ISLANDS</option><br />
		<option value="MQ">MARTINIQUE</option><br />
		<option value="MR">MAURITANIA</option><br />
		<option value="MU">MAURITIUS</option><br />
		<option value="YT">MAYOTTE</option><br />
		<option value="MX">MEXICO</option><br />
		<option value="FM">MICRONESIA, FEDERATED STATES OF</option><br />
		<option value="MD">MOLDOVA, REPUBLIC OF</option><br />
		<option value="MC">MONACO</option><br />
		<option value="MN">MONGOLIA</option><br />
		<option value="ME">MONTENEGRO</option><br />
		<option value="MS">MONTSERRAT</option><br />
		<option value="MA">MOROCCO</option><br />
		<option value="MZ">MOZAMBIQUE</option><br />
		<option value="NA">NAMIBIA</option><br />
		<option value="NR">NAURU</option><br />
		<option value="NP">NEPAL </option><br />
		<option value="NL">NETHERLANDS</option><br />
		<option value="AN">NETHERLANDS ANTILLES</option><br />
		<option value="NC">NEW CALEDONIA</option><br />
		<option value="NZ">NEW ZEALAND</option><br />
		<option value="NI">NICARAGUA</option><br />
		<option value="NE">NIGER</option><br />
		<option value="NU">NIUE</option><br />
		<option value="NF">NORFOLK ISLAND</option><br />
		<option value="MP">NORTHERN MARIANA ISLANDS</option><br />
		<option value="NO">NORWAY</option><br />
		<option value="OM">OMAN</option><br />
		<option value="PW">PALAU</option><br />
		<option value="PS">PALESTINE</option><br />
		<option value="PA">PANAMA</option><br />
		<option value="PY">PARAGUAY</option><br />
		<option value="PE">PERU</option><br />
		<option value="PH">PHILIPPINES</option><br />
		<option value="PN">PITCAIRN</option><br />
		<option value="PL">POLAND</option><br />
		<option value="PT">PORTUGAL</option><br />
		<option value="PR">PUERTO RICO</option><br />
		<option value="QA">QATAR</option><br />
		<option value="RE">REUNION</option><br />
		<option value="RO">ROMANIA</option><br />
		<option value="RU">RUSSIAN FEDERATION</option><br />
		<option value="RW">RWANDA</option><br />
		<option value="SH">SAINT HELENA</option><br />
		<option value="KN">SAINT KITTS AND NEVIS</option><br />
		<option value="LC">SAINT LUCIA</option><br />
		<option value="PM">SAINT PIERRE AND MIQUELON</option><br />
		<option value="VC">SAINT VINCENT AND THE GRENADINES</option><br />
		<option value="WS">SAMOA</option><br />
		<option value="SM">SAN MARINO</option><br />
		<option value="ST">SAO TOME AND PRINCIPE </option><br />
		<option value="SA">SAUDI ARABIA</option><br />
		<option value="SN">SENEGAL</option><br />
		<option value="RS">SERBIA</option><br />
		<option value="SC">SEYCHELLES</option><br />
		<option value="SG">SINGAPORE</option><br />
		<option value="SK">SLOVAKIA</option><br />
		<option value="SI">SLOVENIA</option><br />
		<option value="SB">SOLOMON ISLANDS</option><br />
		<option value="ZA">SOUTH AFRICA</option><br />
		<option value="GS">SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS</option><br />
		<option value="ES">SPAIN</option><br />
		<option value="SR">SURINAME</option><br />
		<option value="SJ">SVALBARD AND JAN MAYEN</option><br />
		<option value="SZ">SWAZILAND</option><br />
		<option value="SE">SWEDEN</option><br />
		<option value="CH">SWITZERLAND</option><br />
		<option value="TW">TAIWAN, PROVINCE OF CHINA</option><br />
		<option value="TZ">TANZANIA, UNITED REPUBLIC OF</option><br />
		<option value="TH">THAILAND</option><br />
		<option value="TL">TIMOR-LESTE</option><br />
		<option value="TG">TOGO</option><br />
		<option value="TK">TOKELAU</option><br />
		<option value="TO">TONGA</option><br />
		<option value="TT">TRINIDAD AND TOBAGO</option><br />
		<option value="TN">TUNISIA</option><br />
		<option value="TR">TURKEY</option><br />
		<option value="TM">TURKMENISTAN</option><br />
		<option value="TC">TURKS AND CAICOS ISLANDS</option><br />
		<option value="TV">TUVALU</option><br />
		<option value="UG">UGANDA</option><br />
		<option value="UA">UKRAINE</option><br />
		<option value="AE">UNITED ARAB EMIRATES</option><br />
		<option value="GB">UNITED KINGDOM</option><br />
		<option value="US">UNITED STATES</option><br />
		<option value="UM">UNITED STATES MINOR OUTLYING ISLANDS</option><br />
		<option value="UY">URUGUAY</option><br />
		<option value="UZ">UZBEKISTAN</option><br />
		<option value="VU">VANUATU</option><br />
		<option value="VE">VENEZUELA</option><br />
		<option value="VN">VIET NAM</option><br />
		<option value="VG">VIRGIN ISLANDS, BRITISH</option><br />
		<option value="VI">VIRGIN ISLANDS, U.S.</option><br />
		<option value="WF">WALLIS AND FUTUNA</option><br />
		<option value="EH">WESTERN SAHARA</option><br />
		<option value="ZM">ZAMBIA</option><br />
		<option value="ZM">ZAMBIA</option>
	</select>

  	<div class="form-group">
		<button class="btn btn-success" type="submit" name="check-out">Paypal Credit Card Payment</button>    
	</div>
</form>
