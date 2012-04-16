function check_url(fld) {
     var theurl=fld.value;
     var tomatch= /http:\/\/[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/
	 if(fld.value){
		 if (tomatch.test(theurl))
		 {
			 return true;
		 }
		 else
		 {
			 fld.value='';
			 fld.focus=true;
			 window.alert("URL invalid. Try again.");
			 return false; 
		 }
	 }
}
function FacebookPopup(){
	var query = "";
	window.open("/facebook_import/examples/example.php" + query,"example","location=0,status=1,scrollbars=1,width=400,height=400");
}
function getXMLHTTP(){ 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e){		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}	 	
		return xmlhttp;
    }
function listsub1() 
{	
	if(document.Registration.category.value!='')
	{
		 hideAllErrors();
		 var selectBox = document.Registration.cate_id;
		 var cate_id = selectBox.options[selectBox.selectedIndex].value;
		 var strURL="ajax/select_state.php?cate_id="+cate_id;
		 var req = getXMLHTTP();
		 if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {						
						document.getElementById('sub1_list').innerHTML=req.responseText;
						document.getElementById('sub2_list').innerHTML='<select name="sub2"  class="dropdown" id="city_id" disabled="disabled"><option value="">Select One</option></select>';
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
}
function listsub2() 
{	
	if(document.Registration.sub1.value!='')
	{
	   	 var selectBox = document.Registration.sub1_id;
		 var sub1_id = selectBox.options[selectBox.selectedIndex].value;
		 var strURL="ajax/select_city.php?sub1_id="+sub1_id;
		 var req = getXMLHTTP();
		 if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('sub2_list').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
}
function check_email()
{ 
	if(document.getElementById("email_id").value!='')
	{
		if (!(/^[0-9a-zA-Z_\.-]+\@[0-9a-zA-Z_\.-]+\.[0-9a-zA-Z_\.-]+$/.test(document.getElementById("email_id").value)))
		 {	 
		   document.getElementById("email_Error").innerHTML = "&nbsp;Invalid Email Address!";
		   document.getElementById("email_id").focus();
           return false;
		 }else{
			document.getElementById("email_Error").innerHTML = "";
		 }
		 var strURL="ajax/check_email.php?email_name="+document.getElementById("email_id").value;
		 var req = getXMLHTTP();
		 if (req){
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {	
						if(req.responseText=="Not Available!"){
							//document.getElementById("email_id").value="";
							document.getElementById('email_Error').innerHTML="Email Address Already Exists.";
							document.getElementById("email_id").focus();							
						}else{					
						document.getElementById('email_Error').innerHTML=req.responseText;}						
					}else{
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}else{
		document.getElementById('email_Error').innerHTML="";
	}
	return true;
}
//Checking the username it it is already exists in the database or not.
	function check_username(){ 
		var illegalChars = /\W/; // allow only letters, numbers, and underscores.
		 if (illegalChars.test(document.getElementById("user_name_reg_id").value))
		 {
			   document.getElementById('user_name_Error').innerHTML = "&nbsp;The username contains illegal characters!";
			   document.getElementById("user_name_reg_id").focus();
			   return false;
		 }
		if(document.getElementById("user_name_reg_id").value!=''){
				var strURL="ajax/check_username.php?user_name="+document.getElementById("user_name_reg_id").value;
				var req = getXMLHTTP();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							if (req.status == 200) {						
								document.getElementById('user_name_Error').innerHTML=req.responseText;						
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}				
					}			
					req.open("GET", strURL, true);
					req.send(null);
				}		
			}
	}
//function to validate firstname and lastname.
function validateFirstname(){
	 var First_last=/[^a-zA-Z0-9\s_]/;
	 if(First_last.test(document.getElementById("first_name_id").value))
		 {     hideAllErrors();
			   document.getElementById('first_name_Error').innerHTML = "&nbsp;The firstname contains illegal characters!";
			   document.getElementById("first_name_id").focus();
			   return false;
		 }else
		 {
			 document.getElementById('first_name_Error').innerHTML='';
		 }
		if (First_last.test(document.getElementById("last_name_id").value))
		 {     hideAllErrors();
			   document.getElementById('last_name_Error').innerHTML = "&nbsp;The lastname contains illegal characters!";
			   document.getElementById("last_name_id").focus();
			   return false;
		 }else{
			document.getElementById('last_name_Error').innerHTML='';
		 }
}
function validation_registration()
{
	 Formname= document.Registration;
	 var illegalChars = /\W/;
	 var First_last=/[^a-zA-Z0-9\s_]/;
	 // allow only letters, numbers, and underscores.
	 if (document.getElementById("user_name_reg_id").value == ""){
		  hideAllErrors();
		  document.getElementById('user_name_Error').innerHTML = "&nbsp;Required: Please Enter User Name!";
		  document.getElementById("user_name_reg_id").focus();
		  return false;
	 }
	 else if (illegalChars.test(document.getElementById("user_name_reg_id").value))
	 {     hideAllErrors();
		   document.getElementById('user_name_Error').innerHTML = "&nbsp;The username contains illegal characters!";
		   document.getElementById("user_name_reg_id").focus();
		   return false;
	 }
	 else if (document.getElementById("user_name_Error").innerHTML == "Not Available!")
	 {     hideAllErrors();
		   document.getElementById('user_name_Error').innerHTML = "&nbsp;Not Available!";
		   document.getElementById("user_name_reg_id").focus();
		   return false;
	 }
	 else if (First_last.test(document.getElementById("first_name_id").value))
	 {     hideAllErrors();
		   document.getElementById('first_name_Error').innerHTML = "&nbsp;The firstname contains illegal characters!";
		   document.getElementById("first_name_id").focus();
		   return false;
	 }
	 else if (First_last.test(document.getElementById("last_name_id").value))
	 {     hideAllErrors();
		   document.getElementById('last_name_Error').innerHTML = "&nbsp;The lastname contains illegal characters!";
		   document.getElementById("last_name_id").focus();
		   return false;
	 }
	 else if (document.getElementById("password_id").value == "")
	 {
	  hideAllErrors();
	  document.getElementById('password_Error').innerHTML = "&nbsp;Required: Please Enter Password!";
	  document.getElementById("password_id").focus();
	  return false;
	 }
	else  if (!(/[A-Z]/.test(document.getElementById("password_id").value)))
	{
	  hideAllErrors();
	  document.getElementById('password_Error').innerHTML = "&nbsp;Required: Passwords must be strong, one uppercase, one number and must be at least 5 characters in length!";
	  document.getElementById("password_id").focus();
	  return false;	
	}
	else  if (!(/[0-9]/.test(document.getElementById("password_id").value)))
	{
	  hideAllErrors();
	  document.getElementById('password_Error').innerHTML = "&nbsp;Required: Passwords must be strong, one uppercase, one number and must be at least 5 characters in length!";
	  document.getElementById("password_id").focus();
	  return false;	
	}
	 else if (document.getElementById("password_id").value.length < 5)
	 {
	  hideAllErrors();
	  document.getElementById('password_Error').innerHTML = "&nbsp;Required: Passwords must be strong, one uppercase, one number and must be at least 5 characters in length!";
	  document.getElementById("password_id").focus();
	  return false; 
	 }
	else if (document.getElementById("confirm_password_id").value == "")
	 {
	  hideAllErrors();
	  document.getElementById('confirm_password_Error').innerHTML = "&nbsp;Required: Please Enter Confirm Password!";
	  document.getElementById("confirm_password_id").focus();
	  return false;
	 }
	else if (document.getElementById("password_id").value != document.getElementById("confirm_password_id").value)
	 {
	  hideAllErrors();
	  document.getElementById('password_Error').innerHTML = "&nbsp;Password Mismatch!";
	  document.getElementById("password_id").focus();
	  document.Registration.password_id.value = "";
	  document.Registration.confirm_password_id.value = "";
	  return false;
	 }
	else if (document.getElementById("email_id").value == "")
	 {
	  hideAllErrors();
	  document.getElementById('email_Error').innerHTML = "&nbsp;Required: Please Enter Email!";
	  document.getElementById("email_id").focus();
	  return false;
	 }
	else  if (!(/^[0-9a-zA-Z_\.-]+\@[0-9a-zA-Z_\.-]+\.[0-9a-zA-Z_\.-]+$/.test(document.getElementById("email_id").value)))
	 {
			hideAllErrors();
			 document.getElementById("email_Error").innerHTML = "&nbsp;Invalid Email Address!";
			 document.getElementById("email_id").focus();
			 return false;
	 }
	 else if (document.getElementById("email_Error").innerHTML == "Not Available!")
	 {     hideAllErrors();
		   document.getElementById('user_name_Error').innerHTML = "&nbsp;Not Available!";
		   document.getElementById("email_id").focus();
		   return false;
	 }
	 else if (document.getElementById("screen_id").value == "")
	 {
	  hideAllErrors();
	  document.getElementById('screen_Error').innerHTML = "&nbsp;Required: Please Enter Stage Name!";
	  document.getElementById("screen_id").focus();
	  return false;
	 }
	 else if (illegalChars.test(document.getElementById("screen_id").value))
	 {
		   document.getElementById('screen_Error').innerHTML = "&nbsp;The stagename contains illegal characters!";
		   document.getElementById("screen_id").focus();
		   return false;
	 }
	 else if (document.getElementById("cate_id").value == "")
	 {
	  hideAllErrors();
	  document.getElementById('cate_Error').innerHTML = "&nbsp;Required: Please Select Country!";
	  document.getElementById("cate_id").focus();
	  return false;
	}
	else if(Formname.image.value)
		{
			hideAllErrors();
			var imagePath = Formname.image.value;
			var pathLength = imagePath.length;
			var lastDot = imagePath.lastIndexOf(".");
			var fileType = imagePath.substring(lastDot,pathLength);
			if((fileType == ".jpg")  ||  (fileType == ".gif")  || (fileType == ".png")|| (fileType == ".JPG")  ||  (fileType == ".GIF")  || (fileType == ".PNG") || (fileType == ".JPEG") || (fileType == ".jpeg")) 
			{
			}
			else
			{
				document.getElementById('image_Error').innerHTML = 'image files should be .jpg, .gif or .png file format.';
				return false;
			}
	 }
return true;
}
function checkPassword(){

if (document.getElementById("password_id").value != document.getElementById("confirm_password_id").value)
	 {
	  hideAllErrors();
	  document.getElementById('password_Error').innerHTML = "&nbsp;Password Mismatch!";
	  document.getElementById("password_id").focus();
	  document.Registration.password_id.value = "";
	  document.Registration.confirm_password_id.value = "";
	  return false;
	 }
	 document.getElementById("password_Error").innerHTML = "" ;
	 document.getElementById("confirm_password_Error").innerHTML = "";
	return true;
}
function hideAllErrors()
{
document.getElementById("user_name_Error").innerHTML = "";
document.getElementById("password_Error").innerHTML = "" ;
document.getElementById("confirm_password_Error").innerHTML = "";
document.getElementById("email_Error").innerHTML = "" ;
document.getElementById("screen_Error").innerHTML = "";
document.getElementById("cate_Error").innerHTML = "";
document.getElementById("image_Error").innerHTML = "";
document.getElementById("first_name_Error").innerHTML = "" ;
document.getElementById("last_name_Error").innerHTML = "";
}
function cleartext()
{
try {
document.getElementById("user_name_reg_id").value = "";
document.getElementById("first_name_id").value = "" ;
document.getElementById("last_name_id").value = "";
document.getElementById("password_id").value = "" ;
document.getElementById("confirm_password_id").value = "";
document.getElementById("email_id").value = "";
document.getElementById("screen_id").value = "";
document.getElementById("Facebook").value = "";
document.getElementById("Twitter").value = "";
document.getElementById("Myspace").value = "";
document.getElementById("image").value = "";
document.getElementById("cate_Error").innerHTML = "";
document.getElementById("image_Error").value = "";
document.getElementById("user_name_Error").innerHTML = "";
document.getElementById("password_Error").innerHTML = "" ;
document.getElementById("confirm_password_Error").innerHTML = "";
document.getElementById("email_Error").innerHTML = "" ;
document.getElementById("screen_Error").innerHTML = "";
} catch (e) {
	
}
return false;
}
function textCounter(field,cntfield,maxlimit) {
	if (field.value.length > maxlimit){ // if too long...trim it!
		field.value = field.value.substring(0, maxlimit);
		// otherwise, update 'characters left' counter
	}else{
		var temp = maxlimit - field.value.length;
		var counter = document.getElementById(cntfield);
		counter.innerHTML = temp+" character left.";
	}
}

