<?php
	// class Addition {
	// 	public static function sum($num1, $num2) {
	// 		return $num1 + $num2;
	// 	}
	// }

	// class Sum extends Addition {
	// 	public function __construct($num1, $num2) {
	// 		echo parent::sum($num1, $num2);
	// 	}
	// }

	// $s = new Sum(10, 45);
	// echo "The sum is ".Addition::sum(10,50);

	// class Message {
	// 	public static $msg = "Hello from Static";

	// 	public static function display() {
	// 		return self::$msg;
	// 	}
	// }

	// class SecondMessage extends Message {
	// 	public static function display() {
	// 		return parent::$msg;
	// 	}
	// }

	// $m = new Message();
	// echo SecondMessage::display();
	
	namespace Practice;

	class OOP {
		public function __construct() {
			echo "This is under Practice Namespace from Practice File";
		}
	}

	// $oop = new OOP();