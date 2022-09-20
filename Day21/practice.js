// var myArray = ["item1", "item2", "item3"];

// var myArray = new Array("item1", "item2", "item3");
// var myArray1 = new Array("item4", "item5", "item2");

// var mergedArray = myArray1.concat(myArray);
// myArray.concat();
// var sortedArray = myArray.sort();

// console.log(mergedArray);
// console.log(sortedArray);

// var numArray = [20, 4, 5, 10, 7, -10];

// var sum = 0;
// for(index in numArray) {
// 	document.write(numArray[index]+"<br>");
// 	sum += numArray[index]; // sum = sum + numArray[index]
// }
// document.write("The sum of array elements is "+ sum);

// var sortedArray = numArray.sort(function(a, b) {
// 	return b - a;
// });

// var max = Math.max.apply(null, numArray);
// var min = Math.min.apply(null, numArray);


// var person = {
// 	"first_name": "alkdf",
// 	"last_name": "aljdflkajl",
// 	"gender": "adjfla",
// 	"isPerson": true,
// 	// "numArray": numArray
// }

// for(key in person) {
// 	console.log(person[key]+"<br>");
// 	// document.write(person);
// }

// person.first_name = "John";
// person.something = "something";

// delete person.something;

// console.log(person);

// var i = 1;

// while(i < 5) {
// 	document.write(i);

// 	i++;
// }

// var j = 1;

// do {
// 	document.write(j);

// 	j+=2;
// } while(j < 5);

// for (var i = 1; i <= 5; i++) {
// 	document.write(i);
// }

// function sum(num1, num2) {
// 	var sum = num1 + num2;
// 	document.write("The sum is "+ sum);
// }

// sum(10, 15);
// sum(25, 26);
// sum(59, 18);


// var num1 = prompt("Enter number 1:");

// if(num1 == '' || num1 == null) {
// 	alert("Please enter number1 to proceed");
// 	num1 = prompt("Enter number 1:");	
// }

// var num2 = prompt("Enter number 2:");
// if(num2 == '' || num2 == null) {
// 	alert("Please enter number2 to proceed");
// 	num1 = prompt("Enter number 2:");	
// }

// var total = parseFloat(num1) + parseFloat(num2);
// alert("The total of two numbers is: "+total);

// var para = document.getElementById('para');
// para.style.color = "red";

// var styles = window.getComputedStyle(para);
// console.log(styles.getPropertyValue("color"));

// para.className = 'newClass';

// para.classList.add('anotherClass');
// para.classList.toggle('newClass');

// para.setAttribute("title", "Hello");

// var newPara = document.createElement("p");
// var newParaText = document.createTextNode("Hello this is a new para");
// newPara.appendChild(newParaText);

// para.appendChild(newPara);

// console.log(newPara.previousSibling.nodeName);

// document.write(contents);

// function showTime() {
//     var d = new Date();
//     document.getElementById("clock").innerHTML = d.toLocaleTimeString();
// }
// setInterval(showTime, 1000);

// document.write("This window is " + document.getElementById('clock').clientWidth + " px wide & " + document.getElementById('clock').clientHeight + " px high, excluding the scrollbars.");


// function age(dateString){
//     var birth = new Date(dateString);
//     var today = new Date();
//     var age = today.getFullYear() - birth.getFullYear();
//     var m = today.getMonth() - birth.getMonth();

//     if(m < 0 || (m === 0 && today.getDate() < birth.getDate())) {
//     	age--;
//     }

//     document.getElementById('age').innerHTML = "You are "+ age + " years old";
// }

// age('February 21, 1990');

// function hideLorem2() {
// 	setTimeout(hide, 5000);
// }

// function hide() {
// 	document.getElementById('lorem2').style.display = "none";
// }

// var count = 1;
// var interval;

// function startCounter() {
// 	interval = setInterval(counter, 1000);
// }

// function counter() {
// 	document.getElementById('numbers').innerHTML = count;
// 	count+=2;
// }

// function pauseCounter() {
// 	clearInterval(interval);
// }

// document.getElementById('btn').onclick = hideLorem2;
// document.getElementById('counter').onclick = startCounter;
// document.getElementById('pauseCounter').onclick = pauseCounter;

// var dateEl = document.getElementById('date');

var countDownDate = new Date("Jan 01, 2023 00:00:00").getTime();

var countInterval = setInterval(function() {
	// var now = new Date().getTime();
	var now = new Date("Jan 02, 2023").getTime();
	var timeLeft = countDownDate - now;
	document.getElementById('countdown').style.display = 'block';

	if(timeLeft < 0) {
		clearInterval(countInterval);
		document.getElementById('countdown').classList.add("finished");
		document.getElementById('countdown').innerHTML = "<h3 class='completed'> HAPPY NEW YEAR </h3>";
	} else {
		var millisecondsInDay = (1000 * 60 * 60 * 24);
		var millisecondsInHour = (1000 * 60 * 60);
		var millisecondsInMinute = (1000 * 60);
		var millisecondsInSecond = 1000;

		var days = Math.floor((timeLeft / millisecondsInDay));
		var hours = Math.floor((timeLeft % millisecondsInDay) / millisecondsInHour); 
		var minutes = Math.floor((timeLeft % millisecondsInHour) / millisecondsInMinute);
		var seconds = Math.floor((timeLeft % millisecondsInMinute) / millisecondsInSecond);

		document.getElementById('days').innerHTML = days;
		document.getElementById('hours').innerHTML = hours;
		document.getElementById('mins').innerHTML = minutes;
		document.getElementById('secs').innerHTML = seconds;
	}
}, 1000);
