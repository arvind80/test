// Place your application-specific JavaScript functions and classes here
// This file is automatically included by javascript_include_tag :defaults
function ShowPartner(value){
	if (value == 'New Partner') {
		window.location='/partners/new?referer=' + 'deal';
	}
}
function getlocation(){
	yqlgeo.get('visitor',function(o){
  	if(o.error){
    	//alert('No location found for user :('); // some IPs are not in the DB :(
  	} else {		
				if ((getCookie("city"))==undefined){	
					document.cookie="city" + "=" + escape ( o.place.admin1.content );
					window.location='/deals/latest?city='+getCookie("city").toLowerCase();
				}
				for( var i=0;i<document.getElementById('subscription_city_id').length;i++){
					if(document.getElementById('subscription_city_id').options[i].text==(getCookie("city").toLowerCase()))
					{
						document.getElementById('subscription_city_id').selectedIndex=i;
					}
				}
	  		}
	});
}

function getCookie(c_name){
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	{
	  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
	  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
	  x=x.replace(/^\s+|\s+$/g,"");
	  if (x==c_name)
	    {
	    return unescape(y);
	    }
	  }
}