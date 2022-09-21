// var btnEl = document.getElementById("test");

// function firstFunction() {
// 	console.log(event);
// 	// alert("The first function executed successfully");
// }

// function secondFunction() {
// 	alert("The second function executed successfully");
// }

// btnEl.onclick = firstFunction;
// btnEl.onclick = secondFunction; // this is overwriting the first function

// btnEl.addEventListener("click", firstFunction);
// btnEl.addEventListener("click", secondFunction);

// window.addEventListener("scroll", function() {
// 	alert("scrolled");
// });

// var elements = document.querySelectorAll("div, p, a");
// for (let elem of elements) {
// 	elem.addEventListener("click", function() {
// 		alert("You clicked: "+this.tagName);
// 		event.stopPropagation();
// 	});
// }

// var obj = {"first_name":"John", "last_name":"Doe", "gender": "Male"};

// var json = JSON.stringify(obj);
// var newObj = JSON.parse(json);


// console.log(json);
// console.log(newObj);

// function squareRoot(number) {
// 	if(number < 0) {
// 		throw new Error("The number must be positive");
// 	} else {
// 		console.log(Math.sqrt(number));
// 	}
// }

// try {
// 	squareRoot(25);
// 	squareRoot(16);
// 	squareRoot(100);
// 	squareRoot(-18);
// } catch(e) {
// 	alert(e.message);
// }


// function firstEvent() {
// 	alert("First Event");
// }

// function secondEvent() {
// 	alert("Second Event");
// }

// var btnEl = document.getElementById('btn');

// btnEl.onclick = firstEvent;
// btnEl.onclick = secondEvent;

// btnEl.addEventListener("click", firstEvent);
// btnEl.addEventListener("click", secondEvent);

// var elements = document.querySelectorAll("div, p, a");

// for(var elem of elements) {
// 	elem.addEventListener("click", function() {
// 		alert("You clicked: " + this.tagName);
// 		event.stopPropagation();
// 	});
// }

var inputEl = document.getElementById('input');

// btnEl.addEventListener("click", function() {
// 	console.log(event);
// });

// inputEl.addEventListener("change", displaySquare);

// function displaySquare() {
// 	var num = event.target.value;
// 	try {
// 		if(num < 0) {
// 			throw new Error("The number cannot be less than 0");
// 		} else {
// 			alert("The square of "+ num +" is "+Math.pow(num,2));
// 		}
// 	} catch(error) {
// 		alert(error.message);
// 	}
// }

// var form = document.querySelector('form');
// form.addEventListener("submit", function() {
// 	event.preventDefault();
// 	console.log(event);
// 	alert("hello");
// });

// inputEl.addEventListener("change", storeData);

// function storeData() {
// 	var num = event.target.value;

// 	localStorage.setItem("number", num);

// 	console.log(localStorage.getItem("number"));

// 	alert("Stored");

// 	localStorage.removeItem("number");
// }