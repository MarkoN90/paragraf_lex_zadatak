<?php

		namespace App;

		class Request {

			use Validation;

			public function __construct() {
					foreach ($_REQUEST as $key => $value) {
						$this->$key = $value;
					}
			}
		}




 ?>
