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

const minutesEl = document.getElementById('minutes');
const secondsEl = document.getElementById('seconds');
const millisecondsEl = document.getElementById('milliseconds');

var milliseconds = 0;
var seconds = 0;
var minutes = 0;

var interval, m, s, ms;

startTimer = () => {
    if(interval!==null){
        clearInterval(interval);
    }
    interval = setInterval(function() {
        milliseconds += 10;
        if(milliseconds == 1000) {
            milliseconds = 0;
            seconds++;

            if(seconds == 60) {
                seconds = 0;
                minutes++;
            }
        }

        m = minutes < 10 ? "0" + minutes : minutes;
        s = seconds < 10 ? "0" + seconds : seconds;
        ms = milliseconds < 10 ? "00" + milliseconds : milliseconds < 100 ? "0" + milliseconds : milliseconds;
        millisecondsEl.innerText = ms;
        secondsEl.innerText = s;
        minutesEl.innerText = m;
    }, 10);
}

stopTimer = () => {
    clearInterval(interval);
}

resetTimer = () => {
    clearInterval(interval);
    millisecondsEl.innerText = "000";
    secondsEl.innerText = "00";
    minutesEl.innerText = "00";
}