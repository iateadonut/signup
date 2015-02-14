//test
var same = 0; //SET TO 2 IF CREATING A SCREEN NAME INSTEAD OF USING EMAIL
var same2 = 2;
var same3 = 2;
var dateOK = 2; //SET TO 2 IF YOU WILL HAVE A BIRTHDATE FIELD; 1 IF NOT
var password1 = 2;
var password2 = 2;
var tzo=(new Date().getTimezoneOffset()/60)*(-1);

$(function() {

	//RUN SCRIPTS IF FIELDS ALREADY HAVE VALUES
	if ( $('#email2').val().length > 1 )
	{
		checkEmail();
	}	
	if ( $('#email4').val().length > 1 )
	{
		checkEmail3();
	}
	if ( $('#email3').val().length > 1 )
	{
		checkEmail2();
	}
	if ( $('#bdate').val().length > 1  ) {
		validateDate();
	}	
	
	
	//BIND
	$('#email3').on('keyup change', function() {
		checkEmail2();
	});
	$('#email4').on('keyup change', function() {
		checkEmail3();
	});
	$('#email2').on('keyup change', function() {
		checkEmail();
	});	
	
	$('#pw').on('keyup change', function() {
		checkPassword();
	});	
	$('#pw2').on('keyup change', function() {
		checkPassword2();
	});	
	$('#bdate').on('keyup change', function() {
		validateDate();
	});	
	
});

function f(o){
  o.value=o.value.replace(/([^0-9A-z])/g,"");
}

function isStringEmail( requestedEmail )
{

	var at="@"
	var dot="."
	var lat=requestedEmail.indexOf(at)
	var lrequestedEmail=requestedEmail.length
	var ldot=requestedEmail.indexOf(dot)
	if (requestedEmail.indexOf(at)==-1){
		same3 = 1;		}
	if (requestedEmail.indexOf(at)==-1 || requestedEmail.indexOf(at)===0 || requestedEmail.indexOf(at)==lrequestedEmail){
		same3 = 1;		}
	if (requestedEmail.indexOf(dot)==-1 || requestedEmail.indexOf(dot)===0 || requestedEmail.indexOf(dot)==lrequestedEmail){
		same3 = 1;		}
	if (requestedEmail.indexOf(at,(lat+1))!=-1){
		same3 = 1;		 }
	if (requestedEmail.indexOf(dot,(lat+2))==-1){
		same3 = 1;		 }
	if (requestedEmail.indexOf(" ")!=-1){
		same3 = 1;		 }					
	//Advanced Email Check credit-
	//By JavaScript Kit (http://www.javascriptkit.com)
	//Over 200+ free scripts here!
	//var terequestedEmailesults
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	if (filter.test(requestedEmail))
	{
		return true;
	} else {
		return false;
	}

}

function enablecreateAccount() {
	//console.log(dateOK+'-dateOK '+same+'-same '+same3+'-same3 '+same2+'-same2 '+password1+'-password1 '+password2+'-password2');
	if (same==0&&same3==0&&same2==0&&password1==1&&password2==1&&dateOK==1)
	{
		document.getElementById('createAccount').disabled = false;
		document.getElementById('createAccount').style.backgroundColor='#79BB88';
	}
	if (same==1||same3==1||same2==1||password1==0||password2==0||dateOK==0)
	{
		document.getElementById('createAccount').disabled = true;
		document.getElementById('createAccount').style.backgroundColor='#DADADA';
	}
}

function checkPassword() {
	password1 = 0;
	var element6 = document.getElementById('PW1');
	while (element6.firstChild) {
	element6.removeChild(element6.firstChild); }
	var font_6 = document.createElement('font');
    font_6.color="red";
    font_6.appendChild(document.createTextNode("too short") );
	element6.appendChild( font_6 );
	if (document.getElementById('pw').value.length > 5)
	{ password1 = 1;
	var element7 = document.getElementById('PW1');
	while (element7.firstChild) {
	element7.removeChild(element7.firstChild); }	
	var font_7 = document.createElement('font');
    font_7.color="green";
    font_7.appendChild(document.createTextNode("OK") );
	document.getElementById('PW1').appendChild( font_7 );	 }
	checkPassword2();
	//console.log( same+'-same '+ same2+'-same2 ' + same3+'-same3')
	if ( same!=0 || same3!=0 || same2!=0 )
	{
		checkEmail();
	}
	enablecreateAccount(); 
	
}

function checkPassword2() {

	password2 = 0;
	var element8 = document.getElementById('PW3');
	while (element8.firstChild) {
	element8.removeChild(element8.firstChild); }
	var font_8 = document.createElement('font');
	font_8.color="red";
	font_8.appendChild(document.createTextNode("passwords don't match") );
	document.getElementById('PW3').appendChild( font_8 );
		
	if (document.getElementById('pw').value == document.getElementById('pw2').value)
	{
		password2 = 1; 
		var element9 = document.getElementById('PW3');
		while (element9.firstChild) {
		element9.removeChild(element9.firstChild); }
		var font_9 = document.createElement('font');
		font_9.color="green";
		font_9.appendChild(document.createTextNode("OK") );
		document.getElementById('PW3').appendChild( font_9 );			 
	}
	
	enablecreateAccount();
}



function checkSN() {
	
	same = 0;
	document.getElementById('createAccount').disabled = true;

	var requestedUsername = document.getElementById('sn2').value.toLowerCase();

	$.ajax({
		type: "POST",
		url: "check.php",
		data: "data="+requestedUsername+"&type=username",
		success: function(msg) {

			same = msg.charAt(0);

			if (requestedUsername.length < 2) {	same=1;	}
			 
			if (same==1)
			{ 
				var element10 = document.getElementById('SN');
				while (element10.firstChild) {
				element10.removeChild(element10.firstChild); }
				var font_10 = document.createElement('font');
				font_10.color="red";
				font_10.appendChild(document.createTextNode("not available") );
				element10.appendChild( font_10 );
			}
			 
			if (same==0)
			{
				var element11 = document.getElementById('SN');
				while (element11.firstChild) {
				element11.removeChild(element11.firstChild); }
				var font_11 = document.createElement('font');
				font_11.color="green";
				font_11.appendChild(document.createTextNode("available") );
				document.getElementById('SN').appendChild(font_11);
			}
			 
			 enablecreateAccount();

		}
	});	 
	 
}


function checkEmail2() {
	
	document.getElementById('sendNewConfirm').disabled = true;
	var same4 = 0;
	var requestedEmail = document.getElementById('email3').value;	

	if ( false == isStringEmail( requestedEmail ) )
	{
		return;
	}
	
	$.ajax({
	type: "POST",
	url: "check",
	data: { email:requestedEmail },
	success: function(msg)
	{

		same4 = msg.charAt(0);
				
		 //if same4 is 1, email exists, which means they can send a confirmation message
		if (same4==1)
		{
			 
			var element12 = document.getElementById('email5');
			while (element12.firstChild) {
			element12.removeChild(element12.firstChild); }	
			var font_12 = document.createElement('font');
			
			if(msg.charAt(1)==0) {
			font_12.color="green";
			font_12.appendChild(document.createTextNode("used") );
			document.getElementById('email5').appendChild( font_12 );
		 	document.getElementById('sendNewConfirm').disabled = false;
		 	document.getElementById('sendNewConfirm').style.backgroundColor='#79BB88';
			}
			if(msg.charAt(1)==1) {
			font_12.color="red";
			font_12.appendChild(document.createTextNode("account already activated") );
			document.getElementById('email5').appendChild( font_12 );
			document.getElementById('sendNewConfirm').disabled = true;
		 	document.getElementById('sendNewConfirm').style.backgroundColor='#DADADA';
			}
	
		}
	
		if (same4==0)
		{
			var element13 = document.getElementById('email5');
			while (element13.firstChild) {
			element13.removeChild(element13.firstChild); }
			var font_13 = document.createElement('font');
			font_13.color="red";
			font_13.appendChild(document.createTextNode("not used") );
			document.getElementById('email5').appendChild( font_13 );
			document.getElementById('sendNewConfirm').disabled = true;
			document.getElementById('sendNewConfirm').style.backgroundColor='#DADADA';
		}
		
	}});
	
}	

function checkEmail3() {
	document.getElementById('passwordReset').disabled = true;
	var same5 = 0;
	var requestedEmail = document.getElementById('email4').value;					
	
	//console.log ('isStringEmail - ' + isStringEmail( requestedEmail ) )
	if ( false == isStringEmail( requestedEmail ) )
	{
		return;
	}
	
	$.ajax({
		type: "POST",
		url: "check",
		data: { email:requestedEmail },
		success: function(msg){

			same5 = msg.charAt(0);
			 
			if (same5==1) {
				var element14 = document.getElementById('email6');
				while (element14.firstChild) {
				element14.removeChild(element14.firstChild); }
				var font_14 = document.createElement('font');
				font_14.color="green";
				font_14.appendChild(document.createTextNode("used") );
				document.getElementById('email6').appendChild( font_14 );
				document.getElementById('passwordReset').disabled = false;
				document.getElementById('passwordReset').style.backgroundColor='#79BB88';
			}
			
			if (same5==0) {
				var element15 = document.getElementById('email6');
				while (element15.firstChild) {
				element15.removeChild(element15.firstChild); }
				var font_15 = document.createElement('font');
				font_15.color="red";
				font_15.appendChild(document.createTextNode("not used") );
				document.getElementById('email6').appendChild( font_15 );		
				document.getElementById('passwordReset').disabled = true;
				document.getElementById('passwordReset').style.backgroundColor='#DADADA';
			}  
		 
		}
	});
}	

	 
function checkEmail() {
	
	document.getElementById('createAccount').disabled = true;
	same2 = 0;
	var requestedEmail = document.getElementById('email2').value;	
	/** * DHTML email validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/) */
	same3 = 0;
	var at="@"
	var dot="."
	var lat=requestedEmail.indexOf(at)
	var lrequestedEmail=requestedEmail.length
	var ldot=requestedEmail.indexOf(dot)
	if (requestedEmail.indexOf(at)==-1){
		same3 = 1;		}
	if (requestedEmail.indexOf(at)==-1 || requestedEmail.indexOf(at)===0 || requestedEmail.indexOf(at)==lrequestedEmail){
		same3 = 1;		}
	if (requestedEmail.indexOf(dot)==-1 || requestedEmail.indexOf(dot)===0 || requestedEmail.indexOf(dot)==lrequestedEmail){
		same3 = 1;		}
	if (requestedEmail.indexOf(at,(lat+1))!=-1){
		same3 = 1;		 }
	if (requestedEmail.indexOf(dot,(lat+2))==-1){
		same3 = 1;		 }
	if (requestedEmail.indexOf(" ")!=-1){
		same3 = 1;		 }					
	//Advanced Email Check credit-
	//By JavaScript Kit (http://www.javascriptkit.com)
	//Over 200+ free scripts here!
	//var terequestedEmailesults
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	if (filter.test(requestedEmail))
	{//terequestedEmailesults=true
	} else {
	same3=1;
	//terequestedEmailesults=false
	}

	//same3 tells if this looks like an email address
	if (same3==1)
	{
		var element16 = document.getElementById('EMAIL');
		while (element16.firstChild) {
		element16.removeChild(element16.firstChild); }
		var font_16 = document.createElement('font');
		font_16.color="red";
		font_16.appendChild(document.createTextNode("invalid email address") );
		document.getElementById('EMAIL').appendChild( font_16 );
		return; //DON'T CHECK BY AJAX IF EMAIL NOT VALID
	}

//alert(same2);

	$.ajax({
		
		type: "POST",
		url: "check",
		data: { email:requestedEmail },
		success: function(msg){
			//alert(msg);
			same2 = msg.charAt(0);
			//alert(same2);

			if (same2==1&&same3!=1) {
				// alert(same2);return;
				var element17 = document.getElementById('EMAIL');
				while (element17.firstChild) {
				element17.removeChild(element17.firstChild); }
				var font_17 = document.createElement('font');
				font_17.color="red";
				font_17.appendChild(document.createTextNode("used") );
				document.getElementById('EMAIL').appendChild( font_17 );
			}

			if (same2==0&&same3!=1) {
				//alert(same2+'test');
				var element18 = document.getElementById('EMAIL');
				while (element18.firstChild) {
				element18.removeChild(element18.firstChild); }
				var font_18 = document.createElement('font');
				font_18.color="green";
				font_18.appendChild(document.createTextNode("not used") );
				document.getElementById('EMAIL').appendChild( font_18 );	
			}

			enablecreateAccount(); 

		}
	});


}	
	 




/** * DHTML date validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/) */
// Declaring valid date character, minimum year and maximum year
var dtCh= "-";
var minYear=1900;
var maxYear=2010;
var strYr;
function isInteger(s){
	var k;
    for (k = 0; k < s.length; k++){   
        // Check that current character is number.
        var c = s.charAt(k);
        if (((c < "0") || (c > "9"))) {return false;}
    }    // All characters are numbers.
    return true;  }
function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) {returnString += c;}
    }
    return returnString;
}
function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 === 0) && ( (!(year % 100 === 0)) || (year % 400 === 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31;
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30;}
		if (i==2) {this[i] = 29;}
   } 
   return this;
}
function isDate(dtStr){
	dateOK=0;
	var daysInMonth = DaysArray(12);
	var pos1=dtStr.indexOf(dtCh);
	var pos2=dtStr.indexOf(dtCh,pos1+1);
	var strYear=dtStr.substring(0,pos1);
	var strMonth=dtStr.substring(pos1+1,pos2);
	var strDay=dtStr.substring(pos2+1);
	strYr=strYear;
	if (strDay.charAt(0)=="0" && strDay.length>1) {strDay=strDay.substring(1);}
	if (strMonth.charAt(0)=="0" && strMonth.length>1) {strMonth=strMonth.substring(1);}
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) {strYr=strYr.substring(1);}
	}
	var month=parseInt(strMonth);
	var day=parseInt(strDay);
	var year=parseInt(strYr);
	if (pos1==-1 || pos2==-1){
		var element = document.getElementById('BDATE1');
		while (element.firstChild) {
		element.removeChild(element.firstChild); }
		var font_0 = document.createElement('font');
		font_0.color="red";
		font_0.appendChild(document.createTextNode("The date format should be : YYYY-MM-DD") );
		document.getElementById('BDATE1').appendChild( font_0 );
		enablecreateAccount();return false;
	}
	if (strMonth.length<1 || month<1 || month>12){		
		var element2 = document.getElementById('BDATE1');
		while (element2.firstChild) {
		element2.removeChild(element2.firstChild); }
		var font_1 = document.createElement('font');
		font_1.color="red";
		font_1.appendChild(document.createTextNode("Please enter a valid month") );
		document.getElementById('BDATE1').appendChild( font_1 );
		enablecreateAccount();return false;
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		
		var element3 = document.getElementById('BDATE1');
		while (element3.firstChild) {
		element3.removeChild(element3.firstChild); }
		var font_2 = document.createElement('font');
		font_2.color="red";
		font_2.appendChild(document.createTextNode("Please enter a valid day") );
		document.getElementById('BDATE1').appendChild( font_2 );
		enablecreateAccount();return false;
	}
	if (strYear.length != 4 || year===0 || year<minYear || year>maxYear){
		
		var element4 = document.getElementById('BDATE1');
		while (element4.firstChild) {
		element4.removeChild(element4.firstChild); }
		var font_3 = document.createElement('font');
		font_3.color="red";
		font_3.appendChild(document.createTextNode("Please enter a valid 4 digit year between "+minYear+" and "+maxYear));
		document.getElementById('BDATE1').appendChild( font_3 );
		enablecreateAccount();return false;
	}
	//if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false) {
		//return false
	//}
		var element5 = document.getElementById('BDATE1');
		while (element5.firstChild) {
		element5.removeChild(element5.firstChild); }
		var font_4 = document.createElement('font');
		font_4.color="green";
		font_4.appendChild(document.createTextNode("OK") );
		document.getElementById('BDATE1').appendChild( font_4 );
		dateOK=1; enablecreateAccount();
}
function validateDate()
{
	var dt=document.getElementById('bdate').value;
	if (isDate(dt)===false){
		return false;
	}
    return true;
}
