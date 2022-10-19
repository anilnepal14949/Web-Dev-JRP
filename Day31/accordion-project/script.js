$('.question').click(function() {
	$.each($('.question'), function(index, question) {
		$(question).next().slideUp("slow");
		$(this).find('i').removeClass("fa-arrow-down").addClass("fa-arrow-right");
	});
	if($(this).next().is(":visible")) {
		$(this).next().slideUp("slow");
		$(this).find('i').removeClass("fa-arrow-down").addClass("fa-arrow-right");
	} else {
		$(this).next().slideDown("slow");
		$(this).find('i').removeClass("fa-arrow-right").addClass("fa-arrow-down");
	}
});