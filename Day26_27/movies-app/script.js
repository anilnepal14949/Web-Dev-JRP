const API_KEY = `a5df0587be9ece2bcbae115d45978a70`;
const IMAGE_PATH = `https://image.tmdb.org/t/p/w1280/`;

// search movies
const input = document.querySelector('.search input');
const searchBtn = document.querySelector('.search button');
const main_grid_title = document.querySelector('.favorites h1');
const main_grid = document.querySelector('.favorites .movies-grid');
const trending_el = document.querySelector('.trending .movies-grid');
const trending_shows_el = document.querySelector('.trending-shows .movies-grid');

const popup_container = document.querySelector('.popup-container');

// Add click event to each movie card
function add_click_to_cards(cards) {
	cards.forEach(card => {
		card.addEventListener("click", () => show_popup(card));
	});
}

// search movies
async function searchMovies(search_term) {
	const resp = await fetch(`https://api.themoviedb.org/3/search/movie?api_key=${API_KEY}&query=${search_term}`)
	const respData = await resp.json();
	return respData.results;	
}

searchBtn.addEventListener('click', getSearchedMovies);
input.addEventListener("keyup", (e) => {
	if(e.key == "Enter" && input.value != "") {
		getSearchedMovies();
	}
});

// get and display searched movies
async function getSearchedMovies() {
	const data = await searchMovies(input.value);
	main_grid.innerHTML = '<div class="loader"></div>';
	main_grid_title.innerText = `Search Results for ${input.value}...`;
	main_grid.innerHTML = data.map(e => {
		return `
			<div class="card" data-id="${e.id}">
				<div class="img">
					<img src="${IMAGE_PATH + e.poster_path}">
				</div>
				<div class="info">
					<h2>${e.title}</h2>
					<div class="single-info">
						<span>Rating:</span>
						<span>${e.vote_average}/10</span>
					</div>
					<div class="single-info">
						<span>Release Date:</span>
						<span>${e.release_date}</span>
					</div>
				</div>
			</div>
		`;
	}).join("");

	// click on the card to show popup
	const cards = document.querySelectorAll('.card');
	add_click_to_cards(cards);
}

// get movie by id
async function get_movie_by_id(id) {
	const resp = await fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=${API_KEY}`);
	const respData = await resp.json();
	return respData;	
}

// get tv show by id
async function get_tv_by_id(id) {
	const resp = await fetch(`https://api.themoviedb.org/3/tv/${id}?api_key=${API_KEY}`);
	const respData = await resp.json();
	return respData;	
}

// get movie trailer
async function get_movie_trailer(id) {
	const resp = await fetch(`https://api.themoviedb.org/3/movie/${id}/videos?api_key=${API_KEY}`);
	const respData = await resp.json();
	return (respData.results.length > 0)?respData.results[0].key:'';	
}

// get show trailer
async function get_tv_trailer(id) {
	const resp = await fetch(`https://api.themoviedb.org/3/tv/${id}/videos?api_key=${API_KEY}`);
	const respData = await resp.json();
	return (respData.results.length > 0)?respData.results[0].key:'';	
}

// display popup
async function show_popup(card) {
	popup_container.classList.add('show-popup');

	const movie_id = card.getAttribute("data-id");
	const type = card.getAttribute("data-type");

	let movie = await get_movie_by_id(movie_id);
	let movie_trailer = await get_movie_trailer(movie_id);
	
	let title = movie.title;
	let release_date = movie.release_date;
	let spoken_languages = movie.spoken_languages[0].name;
	let hideClass = "";

	if(type == "tv") {
		movie = await get_tv_by_id(movie_id);
		movie_trailer = await get_tv_trailer(movie_id);
		title = movie.name;
		release_date = movie.first_air_date;
		spoken_languages = (movie.spoken_languages.length>0)?movie.spoken_languages[0].name:'';
		hideClass = "hide";
	}
	
	let trailer = '';
	if(movie_trailer != '') {
		trailer = `
			<div class="trailer">
				<h2 style="margin-bottom:15px;">Trailer</h2>
				<iframe width="560" height="315" src="https://www.youtube.com/embed/${movie_trailer}" title="Youtube Video Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media, gyroscope, picture-in-picture" allowfullscreen></iframe>
			</div>
		`;
	}

	popup_container.style.background = `linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,1)), url(${IMAGE_PATH + movie.poster_path})`;
	popup_container.innerHTML = `
		<span class="x-icon">&#10006;</span>
		<div class="content">
			<div class="left">
				<div class="poster-img">
					<img src="${IMAGE_PATH + movie.poster_path}">
				</div>
				<div class="single-info ${hideClass}">
					<span>Add to favorites:</span>
					<span class="heart-icon">&#9829;</span>
				</div>
			</div>
			<div class="right">
				<h1> ${title} </h1>
				<h3> ${movie.tagline} </h3>
				<div class="single-info-container">
					<div class="single-info ${hideClass}">
						<span>Language:</span>
						<span>${spoken_languages}</span>
					</div>
					<div class="single-info ${hideClass}">
						<span>Length:</span>
						<span>${movie.runtime} minutes</span>
					</div>
					<div class="single-info">
						<span>Rating:</span>
						<span>${movie.vote_average}/10</span>
					</div>
					<div class="single-info ${hideClass}">
						<span>Budget:</span>
						<span>$${movie.budget}</span>
					</div>
					<div class="single-info">
						<span>Release Date:</span>
						<span>${release_date}</span>
					</div>
				</div>
				<div class="genres">
					<h2>Genres</h2>
					<ul>
						${movie.genres.map(e => `<li>${e.name}</li>`).join("")}
					</ul>
				</div>
				<div class="overview">
					<h2>Overview</h2>
					<p>${movie.overview}</p>
				</div>
				${trailer}
			</div>
		</div>
	`;

	const x_icon = document.querySelector('.x-icon');
	x_icon.addEventListener("click", () => popup_container.classList.remove('show-popup'));

	const heart_icon = document.querySelector('.heart-icon');

	const movie_ids = get_LS()
    for(let i = 0; i <= movie_ids.length; i++) {
        if (movie_ids[i] == movie_id) heart_icon.classList.add('change-color')
    }

	heart_icon.addEventListener("click", () => {
		if(heart_icon.classList.contains('change-color')) {
			remove_LS(movie_id);
			heart_icon.classList.remove('change-color');
		} else {
			add_to_LS(movie_id);
			heart_icon.classList.add('change-color');
		}
		fetch_favorite_movies();
	});
}

// local storage to store favorites
function get_LS() {
	const movie_ids = JSON.parse(localStorage.getItem('movie-id'));
	return movie_ids === null ? [] : movie_ids;
}

function add_to_LS(id) {
	const movie_ids = get_LS();
	localStorage.setItem('movie-id', JSON.stringify([...movie_ids, id]));
}

function remove_LS(id) {
	const movie_ids = get_LS();
	localStorage.setItem('movie-id', JSON.stringify(movie_ids.filter(e => e !== id)))
}

fetch_favorite_movies();
async function fetch_favorite_movies() {
	main_grid.innerHTML = '';
	const movies_ls = await get_LS();
	const movies = [];

	for(let i=0; i<=movies_ls.length-1;i++) {
		const movie_id = movies_ls[i];
		let movie = await get_movie_by_id(movie_id);
		display_favorites(movie);
		movies.push(movie);
	}
}

function display_favorites(e) {
	main_grid.innerHTML += `
		<div class="card" data-id="${e.id}" data-type="movie">
			<div class="img">
				<img src="${IMAGE_PATH + e.poster_path}">
			</div>
			<div class="info">
				<h2>${e.title}</h2>
				<div class="single-info">
					<span>Rating:</span>
					<span>${e.vote_average}/10</span>
				</div>
				<div class="single-info">
					<span>Release Date:</span>
					<span>${e.release_date}</span>
				</div>
			</div>
		</div>
	`;

	const cards = document.querySelectorAll('.card');
	add_click_to_cards(cards);
}

// Trending Movies
get_trending_movies("movie");
get_trending_movies("tv");
async function get_trending_movies (type) {
    const resp = await fetch(`https://api.themoviedb.org/3/trending/${type}/day?api_key=${API_KEY}`);
    const respData = await resp.json();
    return respData.results;
}

display_trending("movie", trending_el);
display_trending("tv", trending_shows_el);
async function display_trending (type, container) {
	container.innerHTML = '<div class="loader"></div>';
    const data = await get_trending_movies(type);
    container.innerHTML = data.slice(0, 6).map(e => {
    	let title = release_date = '';
    	if(type == "tv") { 
    		title = e.name; 
    		release_date = e.first_air_date; 
    	} else { 
    		title = e.title ;
    		release_date = e.release_date;
    	}
        return `
            <div class="card" data-id="${e.id}" data-type="${type}">
                <div class="img">
                    <img src="${IMAGE_PATH + e.poster_path}">
                </div>
                <div class="info">
                    <h2>${title}</h2>
                    <div class="single-info">
                        <span>Rate: </span>
                        <span>${e.vote_average} / 10</span>
                    </div>
                    <div class="single-info">
                        <span>Release Date: </span>
                        <span>${release_date}</span>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}
