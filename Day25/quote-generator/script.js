const quoteText = document.querySelector('.quote');
const authorName = document.querySelector('.author .name');
const quoteBtn = document.querySelector("button");
const soundBtn = document.querySelector(".sound");
const copyBtn = document.querySelector(".copy");
const copiedText = document.querySelector(".copy span");
const tweetBtn = document.querySelector(".twitter");

const url = 'https://api.quotable.io/random';

// function to generate random quotes
let randomQuote = () => {
	quoteBtn.classList.add("loading");
	quoteBtn.innerText = "Loading Quote...";

	// fetch random quotes 
	fetch(url)
		.then(res => res.json())
		.then(quote => {
			quoteText.innerText = quote.content;
			authorName.innerText = quote.author;
			quoteBtn.classList.remove("loading");
			quoteBtn.innerText = "New Quote";
		});
}

quoteBtn.addEventListener("click", randomQuote);

soundBtn.addEventListener("click", () => {
	// use SpeechSynthesisUtterance; a web speech api
	let utterance = new SpeechSynthesisUtterance(`${quoteText.innerText} by ${authorName.innerText}`);
	speechSynthesis.speak(utterance);
});

copyBtn.addEventListener("click", function() {
	// using navigator to copy the quote text in clipboard
	navigator.clipboard.writeText(quoteText.innerText);
	copiedText.style.display = "block";

	setTimeout(function() {
		copiedText.style.display = "none";
	}, 2000);
});

tweetBtn.addEventListener("click", () => {
	let tweetUrl = `https://twitter.com/intent/tweet?url=${quoteText.innerText}`;
	window.open(tweetUrl, "_blank");
});

randomQuote();