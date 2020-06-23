<?php
		require '../vendor/autoload.php';

		$session = new App\Session;

		$request = new App\Request;

		$polisaOsiguranja = new App\PolisaOsiguranja();

		$polisaOsiguranja->kreiraj_polisu($request);

		if(!empty($request->errors)) {
			$session->put('errors', $request->errors);
		}  else {
			$session->put('message', "Polisa je uspesno kreirana.");
		}

		 redirect_to('index.php');

 ?>
