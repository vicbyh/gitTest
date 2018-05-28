
	function validatereg()
	{
		var user 	= document.regForm.alias.value; 
		var epost 	= document.regForm.mail.value;
		var password= document.regForm.pass.value;
		
		if (user.trim() == "" || epost.trim() == "" || password.trim() == "")
		{

<<<<<<< HEAD
			alert("Var välnlig fyll i alla fält");	
=======
			alert("Var vänlig fyll i alla fält");	
>>>>>>> 59b4d5e2b0e804a4db650cc7a818ee6ebebd9af1
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
<<<<<<< HEAD
			 alert ("Du har nu registrerats");
=======
			 alert ("Du är nu registrerad");
>>>>>>> 59b4d5e2b0e804a4db650cc7a818ee6ebebd9af1
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
