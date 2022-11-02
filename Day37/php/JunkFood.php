<?php

include "Food.php";

use Edible as E;

class JunkFood {
	public function __construct() {
		$f = new E\Food("Mo:Mo");
		echo $f->displayFood();
	}
}

$jf = new JunkFood();