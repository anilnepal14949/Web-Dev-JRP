const wrapper = document.querySelector(".wrapper");
const inputPart = document.querySelector(".wrapper .input-part");
const infoTxt = document.querySelector(".input-part .info-txt");
const inputField = document.querySelector(".input-part input");
const locationBtn = document.querySelector(".input-part button");
const wIcon = document.querySelector(".weather-part .bigicon");
const backArrow = document.querySelector(".wrapper header i");

// url with weather api
const api_key = '13f0d2258951e8f9c0c0a83a4e32adda';

let updateWeather = (report) => {
	infoTxt.classList.replace("pending", "error");
	if(report.cod == "404") {
		infoTxt.innerText = `${inputField.value} is not a valid city`;
	} else {
		const city = report.name;
		const country = report.sys.country;
		const { id, description } = report.weather[0];
		const { feels_like, humidity, temp } = report.main;

		if(id == 800) {
			wIcon.className = "";
			wIcon.className = "fas fa-sun bigicon";
		} else if(id >= 200 && id <= 232) {
			wIcon.className = "";
			wIcon.className = "fas fa-cloud-bolt bigicon";
		} else if(id >= 600 && id <= 622) {
			wIcon.className = "";
			wIcon.className = "fas fa-snowflake bigicon";
		} else if(id >= 701 && id <= 781) {
			wIcon.className = "";
			wIcon.className = "fas fa-smog bigicon";
		} else if(id >= 801 && id <= 804) {
			wIcon.className = "";
			wIcon.className = "fas fa-cloud-sun bigicon";
		} else if((id >= 300 && id <= 321) || (id >= 500 && id <= 531)) {
			wIcon.className = "";
			wIcon.className = "fas fa-cloud-showers-water bigicon";
		}

		wrapper.querySelector(".temp .numb").innerText = Math.floor(temp);
		wrapper.querySelector(".weather").innerText = description;
		wrapper.querySelector(".location span").innerText = `${city}, ${country}`;
		wrapper.querySelector(".feels .temp span").innerText = Math.floor(feels_like);
		wrapper.querySelector(".humidity .temp span").innerText = humidity;

		inputField.value = "";
		infoTxt.classList.remove("pending", "error");
		wrapper.classList.add("active");
	}
}

let getWeather = (url) => {
	infoTxt.innerText = "Getting Weather Details...";
	infoTxt.classList.add("pending");
	fetch(url)
		.then(res => res.json())
		.then(result => updateWeather(result));
}

let requestApi = (city) => {
	let url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${api_key}`;
	getWeather(url);
}

inputField.addEventListener("keyup", e => {
	if(e.key == "Enter" && inputField.value != "") {
		requestApi(inputField.value);
	}
});

locationBtn.addEventListener("click", () => {
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(onSuccess, onError);
	} else {
		alert("Your browser doesnot support geolocation");
	}
});	

let onSuccess = position => {
	// destructuring latitude and longitude from position.coords
	const {latitude, longitude} = position.coords;

	let url = `https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&units=metric&appid=${api_key}`;
	getWeather(url);
}

let onError = error => {
	infoTxt.innerText = error.message;
	infoTxt.classList.add("error");
}

backArrow.addEventListener("click", () => {
	wrapper.classList.remove("active");
});