$(document).ready(function() {
	// $("ul li").slice(-3, -1).addClass("selected");
	// $("div").first().addClass("selected");
	// $("div").has("p").addClass("selected");
	$("form").submit(function(e) {
		e.preventDefault();

		var formData = $(this).serialize();
		console.log(formData);
	});
});