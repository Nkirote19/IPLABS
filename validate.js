//we create a function to validate the form
//we will call the function when the form is submitted

function validateForm(){
	var fname = document.forms["user_details"]["first_name"].value;
	var lname = document.forms["user_details"]["last_name"].value;
	var city = document.forms["user_details"]["city_name"].value;
//note user_details is the name of our form
	if(fname == null || lname == null || city == null){
		alert("all details that are required were not suppllied");
		return false;
	}
	return true;
}