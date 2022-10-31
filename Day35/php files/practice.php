<?php
	// $a = 15;

	// try {
	// 	if($a > 18) {
	// 		throw new Exception("Must be less than 18");
	// 		echo "Hello! ";
	// 	}
	// } catch(Exception $e) {
	// 	echo $e->getMessage(); 
	// } finally {
	// 	echo "<br> Thank you";
	// }

	// function sayHello() {
	// 	echo "Hello";
	// }

	// class SayHello {
	// 	private $msg;

	// 	public function __construct($msg) {
	// 		$this->msg = $msg;
	// 	}

	// 	protected function display() {
	// 		echo $this->msg;
	// 	}
	// }

	// class SayHelloChild extends SayHello {
	// 	private $msg2 = "This is msg2";

	// 	public function display() {
	// 		// $this->display();
	// 		echo $this->msg2;
	// 	}
	// }

	// $hello = new SayHelloChild("Hello World!");
	// $hello->display();
	// $world = new SayHelloChild("Hello World Again!");
	// $world->display();


	// class LanguagesConstant {
	// 	const PHP = "PHP";
	// 	const JS = "JAVASCRIPT";
	// }

	// echo LanguagesConstant::JS;

	// abstract class Abs {
	// 	public $msg = "This is abstraction class";

	// 	abstract public function display();
	// }

	// interface Inter {
	// 	public function sum();
	// }

	// class AbsChild extends Abs implements Inter {
	// 	public function display() {
	// 		echo $this->msg;
	// 	}

	// 	public function sum() {
	// 		$sum = 10 + 20;
	// 		echo "The sum is ".$sum;
	// 	}
	// }

	// $abs = new AbsChild();
	// $abs->display();
	// $abs->sum();

	// trait Sum {
	// 	public function displaySum($num1, $num2) {
	// 		echo "The sum is ".($num1+$num2);
	// 	}
	// }

	// class Operation {
	// 	use Sum;
	// }

	// class Successful {
	// 	use Sum;
	// }

	// $op = new Operation();
	// $op->displaySum(10, 15);

	// $sf = new Successful();
	// $sf->displaySum(25, 60);


?>