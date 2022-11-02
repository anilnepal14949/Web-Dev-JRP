<?php

namespace Edible;

class Food {
	public $favFood;

	public function __construct($fav) {
		$this->favFood = $fav;
	}

	public function displayFood() {
		return "My favourite food is ".$this->favFood;
	}
}

// $f = new Food("Noodles");
// echo $f->displayFood();