<?php

// Exercise 1
// class Vehicle {
// 	public static $model, $color, $price;

// 	public function __construct($m, $c, $p) {
// 		self::$model = $m;
// 		self::$color = $c;
// 		self::$price = $p;
// 	}

// 	public static function displayInfo() {
// 		return "Model: ".self::$model." Color: ".self::$color." Price:".self::$price;
// 	}
// }

// $v = new Vehicle("ABC", "red", 12048);
// echo Vehicle::displayInfo();

// Exercise 2
// class Car extends Vehicle {
// 	public static $isElectric = true;

// 	public function __construct($m, $c, $p, $isE) {
// 		self::$model = $m;
// 		self::$color = $c;
// 		self::$price = $p;
// 		self::$isElectric = $isE;
// 	}

// 	public static function isElectric() {
// 		return self::$isElectric;
// 	}
// }

// $c = new Car("Toyota", "Black", "12500", false);
// if(Car::isElectric()) {
// 	echo Car::displayInfo();
// }

