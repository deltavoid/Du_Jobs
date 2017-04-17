$(document).ready(function(){
			
		$(".register").hide();
		$(".forget").hide();
		$("#account").click(function(){
			$(".login").hide();
			$(".register").show();
			$('h1#clog').html("Sign Up");
		});

		$("#login").click(function(){
			$(".register").hide();
			$(".login").show();
			$('h1#clog').html("login");
		});

		$("#flogin").click(function(){
			$(".forget").hide();
			$(".login").show();
		});


		$("#forget").click(function(){
			$(".login").hide();
			$(".forget").show();
		});
	});
	function forgotPassCon() {
  		var xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    		if(this.responseText!="failed"){
      			//alert("sent");
      			swal("Sent", "A mail has been sent", "success");

      			// window.location="../login/login.html";
    		}
      		else
      			swal("Nope", "You aren't registered", "error");
    	}
  		};
  		xhttp.open("POST", "../php/forgetProcess.php", true);
  		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  		xhttp.send("email="+document.getElementById("email").value); 
  	} 
  	