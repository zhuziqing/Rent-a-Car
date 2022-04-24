$(document).ready(function() {

	$("#detail").click(function() {
		$("#first").slideUp("slow", function(){
			$("#second").slideDown("slow");
		});
    });
    
	$("#back").click(function() {
		$("#second").slideUp("slow", function(){
			$("#first").slideDown("slow");
		});
	});



});
