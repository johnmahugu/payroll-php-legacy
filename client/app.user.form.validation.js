jQuery(document).ready(function($){	


	User.validate = function(username,password, confirmPassword){
	
		if(!username.length){
		
			alert('Missing Username!');
			
			return false;
		}	
		else if(username.length < 6){
		
			alert("Username should be greater or equal to 6 characters!");
			
			return false;
		}
		else if(!password.length || !confirmPassword.length){ //Check Emptiness
		
			alert("Enter Password(s)!");

			return false;
		}	
		else if(password != confirmPassword){
		
			alert("Passwords donnot match!");

			return false;
		}
		else if(password.length < 8 || confirmPassword.length < 8){
		
			alert("Password should be greater or equal to 8 characters!")

			return false;
		}
		else return true; 	
	}
	
});