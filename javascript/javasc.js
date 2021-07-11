$(document).ready(function(){

	$("#btn-signin").on("click", function(){
		signin_();
	});

	$("#btn-signup").on("click", function(){
		signup_();
	});
	
	$("#btn-signout").on("click", function(){
		signout_();
	});

//---------------------------------------------

	function signin_()
	{
		window.location.href = "index.php?rt=login/index";
	}
	function signup_()
	{
		window.location.href = "index.php?rt=login/index";
	}
	function signout_()
	{
		window.location.href = "index.php?rt=login/logout";
		
	}
});




