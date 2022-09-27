// regular expressions


// var regex = /a[r|p|e]e/ig;
// var str = "Are, Ape, Axe, Apple, Anything";

// if(regex.test(str)) {
// 	console.log("Match found");
// } else {
// 	console.log("Match not found");
// }
// var matches = str.match(regex);

// if(matches != null) {
// 	console.log(matches);
// }


// var regex = /RegEx[pt]/;
// var str = "We are learning RegEx today. RegExp is also fun";

// if(regex.test(str)) {
//     document.write("Match found!");
// } else {
//     document.write("Match not found.");
// }
// var matches = str.match(regex);
// document.write(matches+" found!")

// var regex = /\s/g;

// var replacement = "-";
// var str = "Earth revolves around \n the \t Sun";

// document.write(str.replace(regex, replacement)+"<hr>");
// document.write(str.replace(/ /g, "-"));

// var regex = /[p{3,}]/;
// var str = "Happy";

// document.write(regex.test(str));

// var request = new XMLHttpRequest();
// request.open("GET", "https://reqres.in/api/users", true);
// request.onload = function(){
//     console.log(request.responseText);
// };
// request.send();

// function save() {
// 	var request = new XMLHttpRequest();

// 	request.open("POST", "https://reqres.in/api/users", true);
// 	request.onload = function() {
// 		console.log(request.response);
// 		document.getElementById('result').innerHTML = "<h3> Data Saved: </h3>"+myForm.name.value+", "+myForm.email.value;
// 	}
// 	request.send();
// }

// function save() {
// 	// alert("Saved");
// 	var request = new XMLHttpRequest();

// 	request.open("POST", "https://reqres.in/api/users", true);

// 	request.onload = function() {
// 		console.log(request.response);
// 		document.getElementById('result').innerHTML = "<h3> Data Saved: </h3>"+myForm.name.value+", "+myForm.email.value;
// 	}

// 	request.send();
// }

// let num1 = 10;
// const PI = 3.1415;

// let myArr = [10,20,13,26];

// for (let arr of myArr) {
// 	console.log(arr);
// }
// console.log(arr);

// let arr = [1,20,30];

// for (var arr of myArr) {
// 	console.log(arr);
// }
// console.log(arr);

// let str = "This is a string";
// str += "aljdflkajdlf";
// str += "adlkfjalk";

// let str = `This is a string
// adlkfjaldf
// adlkfjaldfaldkfjal
// lakdjflkas`;

let num1 = 20;
let num2 = 30;


// console.log("The sum of "+num1+" and "+num2+" is "+total);
// console.log(`The sum of ${num1} and ${num2} is ${total}`);
let total = num1 + num2;

// var sum = (num1, num2=30) => console.log(`The sum of ${num1} and ${num2} is ${total}`);

let sum = (num1, num2=40) => {
	let total = num1 + num2;
	console.log(`The sum of ${num1} and ${num2} is ${total}`);	
}

// function sum(num1, num2=30) {
// 	let total = num1 + num2;
// 	console.log(`The sum of ${num1} and ${num2} is ${total}`);	
// }

sum(num1);