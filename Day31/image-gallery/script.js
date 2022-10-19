const gallery = $('.gallery');
const lightbox = $('.lightbox');
const lightboxImg = $('.lightbox .image .img');
const closeBtn = $('.lightbox .close');

$.each(gallery, function(index, gal) {
	$(gal).click(function() {
		let img = $(gal).html();
		lightboxImg.html(img);
		lightbox.show(100);
	});
});

closeBtn.click(function() {
	lightbox.hide(100);
});

$(window).keyup(function(e) {
	if(e.keyCode == 27) {
		lightbox.hide(100);
	}
});