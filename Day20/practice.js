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

// function deleteThis() {
// 	var del = confirm("Are you sure to delete this?");

// 	if(del) {
// 		alert("Successfully Deleted");
// 	}
// }

// function calculate() {
// 	var input1 = prompt("Enter number 1:");
// 	var input2 = prompt("Enter number 2:");

// 	var total = parseFloat(input1) + parseFloat(input2);

// 	alert("The total of "+input1+" and "+input2+" is: "+total);
// }

var dom = document.querySelector('.dom');
var domTitle = document.getElementById("dom_title");
var domTitle = document.querySelector("#dom_title");
var paras = document.getElementsByClassName("para");
var paras = document.querySelectorAll(".para");
var btn = document.querySelector("button");

domTitle.style.color = "red";
domTitle.style.padding = "10px";
domTitle.style.border = "2px solid red";

// console.log(dom.firstElementChild);
console.log(domTitle.previousElementSibling);

// btn.classList.add('readMore');
// dom.removeChild(document.querySelector('.readMore'));

// var button = document.createElement("button");
// dom.appendChild(button);
// button.innerHTML = "<i>Read Less</i>";
// console.log(domTitle.innerHTML);

// domTitle.className = "dom_title";
// domTitle.classList.add("dom_title2");
// domTitle.classList.remove("dom_title");

// btn.setAttribute("title", "Click this button to read more.");
// console.log(btn.getAttribute("onclick"));
// console.log(domTitle.getAttribute("style"));
// btn.removeAttribute("title");



// function remove() {
	// domTitle.classList.toggle("dom_title");
	// if(domTitle.classList.contains("dom_title")) {
	// 	domTitle.classList.remove("dom_title");
	// } else {
	// 	domTitle.classList.add("dom_title");
	// }
// }

// var styles = window.getComputedStyle(dom);
// var dom_margin = styles.getPropertyValue("margin");

// if(dom_margin > 10) {
// 	dom.style.margin = "20px";
// } else {
// 	dom.style.margin = "30px";
// }

// console.log(styles.getPropertyValue("margin"));


