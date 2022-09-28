const starsEl = document.querySelectorAll(".fa-star");
const emojisEl = document.querySelectorAll(".emoji-container .far");

const colorsArr = ["red", "orange", "lightblue", "lightgreen", "green"];

let updateRating = index => {
	starsEl.forEach((starEl, idx) => {
		if(idx <= index) {
			starEl.classList.add("active");
		} else {
			starEl.classList.remove("active");
		}
	});

	emojisEl.forEach((emojiEl) => {
		emojiEl.style.transform = `translateX(-${index * 50}px)`;
		emojiEl.style.color = colorsArr[index];
	});
}

starsEl.forEach((starEl, index) => {
	starEl.addEventListener("click", () => updateRating(index));
});

updateRating(0);


