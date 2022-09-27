const url = "https://api.chucknorris.io/jokes/random";
const jokeContainer = document.getElementById("joke");
const btnEl = document.getElementById("btn");

let getJoke = () => {
	jokeContainer.classList.remove('fade');
	fetch(url)
		.then(response => response.json())
		.then(joke => {
			jokeContainer.innerHTML = `${joke.value}`;
			jokeContainer.classList.add('fade');
		});
}

btnEl.addEventListener("click", getJoke);
getJoke();