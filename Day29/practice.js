$(document).ready(function() {
	const paraId = $("#para");
	$("#button1").click(function() {
		// paraId
		// 	.animate({ width: "+=120px" }, "slow")
		// 	.animate({ padding: "+=60px" }, "slow");
		// console.log(paraId.attr("id"));
		// paraId.wrap("<div class='paraDiv'></div>");
		// paraId.toggleClass("box");
		paraId.css("width", "250px");
		console.log("Width:"+paraId.width());
		console.log("InnerWidth:"+paraId.innerWidth());
		console.log("OuterWidth:"+paraId.outerWidth());
		console.log("OuterWidthWMargins:"+paraId.outerWidth(true));
	});

	// $("#button2").click(function() {
	// 	paraId.stop(true, true);
	// });

	$("#button2").click(function() {
		// paraId.attr("id", "updated_para");
		// paraId.after("This is text after p");
		// paraId.unwrap();
		// paraId.removeAttr("id");
		// console.log(paraId.css("border"));
		console.log("Height:"+paraId.height());
		console.log("InnerHeight:"+paraId.innerHeight());
		console.log("OuterHeight:"+paraId.outerHeight());
		console.log("OuterHeightWMargins:"+paraId.outerHeight(true));
	});


	// get input fields value: inputEl.val();
	// set input fields value: inputEl.val("This is the value");
});
