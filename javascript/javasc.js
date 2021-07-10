$(document).ready(function(){

	$("#btn-signin").on("click", function(){
		signin_();
	});

	function signin_()
	{
		window.location.href = "index.php?rt=login/index";
	}
});





