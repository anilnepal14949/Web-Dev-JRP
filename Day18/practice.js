// Conditional Statements

var a = -15;

var rem = a % 2;

switch(rem) { // condition
	case 0: // value = 0
		console.log("Even Number");
		break;
	case 1: // value = 1
		console.log("Odd Number");
		break;
	default: // value not 0 or 1 (else)
		console.log("Nothing");
}

if(a % 2 == 0) {
	console.log("Even Number");
} else if(a % 2 == 1) {
	console.log("Odd Number");
} else {
	console.log("Nothing");
}

var first_name = "John";
var last_name = "Doe";

var initials = "JD";