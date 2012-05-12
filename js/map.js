/* Get location latlng position */
var geocoderAPI = new google.maps.Geocoder();
var targetObj; //var to hold the target object where the api result it to be stored

function getLatLng(target, source)
{
	var loc = source.value;
	targetObj = document.getElementById(target);
	var address = {
	    address: loc
	}
	geocoderAPI.geocode(address, function (response, status)  {
	    if(status == google.maps.GeocoderStatus.OK) {
	        latlng = response[0].geometry.location;
		latlng = latlng.$a+","+latlng.ab;
		//console.log("target:"+target+":"+latlng);
	    	//target = document.getElementById(target);
	    	targetObj.value = latlng;
	    } else  {
	        console.log("Unable to find LatLng for address. Error:" + status);
	    }
	});
}