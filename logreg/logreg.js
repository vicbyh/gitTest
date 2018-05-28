
	function validatereg()
	{
		var user 	= document.regForm.alias.value; 
		var epost 	= document.regForm.mail.value;
		var password= document.regForm.pass.value;
		
		if (user.trim() == "" || epost.trim() == "" || password.trim() == "")
		{

			alert("Var välnlig fyll i alla fält");	
		}  
		else
		{
			ValidateEmail(epost.trim());
		}
	}	
		function ValidateEmail(epost)
		{
			console.log(epost);

		
			var thisRegex = /^[A-z0-9._]+@[A-z]+\.[a-z]+$/;
			if (thisRegex.test(epost))
			{
			 alert ("Du har nu registrerats");
			}
			else
			{
				alert("Du har skrivit in en felaktig email");
			}	
		
		}
	function validatelogin ()
	{
		var epost = document.loginForm.mail.value;
		var password = document.loginForm.pass.value;

		if (epost.trim() == "" || password.trim() == "") 
		{

		alert("Du har skrivit in fel !");
		return false;	

		}	
	}
