<?php
// Exercise 1
// function divide($num1, $num2) {
// 	try {
// 		if($num2 == 0) {
// 			throw new Exception("Cannot divide by zero");
// 		} else {
// 			echo "The division is:".($num1/$num2);
// 		}
// 	} catch(Exception $e) {
// 		echo $e->getMessage();
// 	}
// }

// divide(10, 0);

// Exercise 2
// class First {
// 	public function display() {
// 		echo "Yuppie! This is my first PHP Class";
// 	}
// }

// $f = new First();
// $f->display();

// Exercise 3
// class Rectangle {
// 	protected $length;
// 	protected $height;

// 	public function __construct($len, $hei) {
// 		$this->length = $len;
// 		$this->height = $hei;
// 	}

// 	public function area() {
// 		$area = $this->length * $this->height;
// 		return $area;
// 	}
// }

// $rect = new Rectangle(10, 25);
// echo "The area is ".$rect->area();

// Exercise 4
// class Square extends Rectangle {
// 	public function __construct($len) {
// 		$this->length = $len;
// 		$this->height = $len;
// 	}

// 	public function perimeter() {
// 		return 4*$this->length;
// 	}
// }
// $sqr = new Square(20);
// echo "The area of square is ".$sqr->area();
// echo "The perimeter of square is ".$sqr->perimeter();

// Exercise 5
// abstract class Operations {
// 	protected $num1, $num2;

// 	public function __construct($n1, $n2) {
// 		$this->num1 = $n1;
// 		$this->num2 = $n2;
// 	}

// 	abstract public function add();
// 	abstract public function subs();
// 	abstract public function prod();
// 	abstract public function divide();
// }

// class Calculate extends Operations {
// 	public function add() {
// 		return $this->num1 + $this->num2;
// 	}

// 	public function subs() {
// 		return $this->num1 - $this->num2;
// 	}

// 	public function prod() {
// 		return $this->num1 * $this->num2;
// 	}

// 	public function divide() {
// 		try {
// 			if($this->num2 == 0) {
// 				throw new Exception("Cannot divide by zero");
// 			} else {
// 				return $this->num1 / $this->num2;
// 			}
// 		} catch(Exception $e) {
// 			return $e->getMessage();
// 		}
// 	}
// }

// $calc = new Calculate(20, 0);
// echo "Sum: ".$calc->add()."<br>";
// echo "Diff: ".$calc->subs()."<br>";
// echo "Prod: ".$calc->prod()."<br>";
// echo "Division: ".$calc->divide()."<br>";


// Exercise 6
// interface Operations {
// 	public function add();
// 	public function subs();
// 	public function prod();
// 	public function divide();
// }

// class Calculate implements Operations {
// 	public $num1, $num2;

// 	public function __construct($n1, $n2) {
// 		$this->num1 = $n1;
// 		$this->num2 = $n2;
// 	}

// 	public function add() {
// 		return $this->num1 + $this->num2;
// 	}

// 	public function subs() {
// 		return $this->num1 - $this->num2;
// 	}

// 	public function prod() {
// 		return $this->num1 * $this->num2;
// 	}

// 	public function divide() {
// 		try {
// 			if($this->num2 == 0) {
// 				throw new Exception("Cannot divide by zero");
// 			} else {
// 				return $this->num1 / $this->num2;
// 			}
// 		} catch(Exception $e) {
// 			return $e->getMessage();
// 		}
// 	}
// }

// $calc = new Calculate(20, 0);
// echo "Sum: ".$calc->add()."<br>";
// echo "Diff: ".$calc->subs()."<br>";
// echo "Prod: ".$calc->prod()."<br>";
// echo "Division: ".$calc->divide()."<br>";

// Exercise 7
// trait Welcome {
// 	public function displayMessage($msg) {
// 		return $msg;
// 	}
// }

// trait WelcomeAgain {
// 	public function displayMessage2($msg) {
// 		return $msg;
// 	}
// }

// class Greetings {
// 	use Welcome, WelcomeAgain;
// }

// $greet = new Greetings();
// echo $greet->displayMessage("Hello, Welcome to OOP")."<br>";
// echo $greet->displayMessage2("Welcome Again to OOP");
