<?php

	namespace App;

		trait Validation
		{
			public $errors = [];

			public function validate($data) {

		 		foreach ($data as $field => $method) {
		 			$this->$method($field);
		 		}
				if(!empty($this->errors)) {
					return;
				}
 			}

			function required($field)	{
				if($this->$field == '') {
					$this->errors[] = $field . ' polje je obavezno';
				}
			}
		}











 ?>
