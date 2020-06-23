<?php

		function dd($toDump) {
			echo "<pre>";
			var_dump($toDump);
			echo "</pre>";
			exit;
		}

		function redirect_to($location) {
				header("Location: {$location}");
		}


		function error($message) {
			echo "<h2 class=\"flash-message\"> {$message} <h2>";
			exit;
		}


		function message($session) {

			if($session->has('message')) {
				$message = $session->get('message');
				echo "<h4 class=\"flash-message\"> {$message} <span onclick=\"parentElement.remove()\"> Zatvori </span></h4>";
				$session->forget('message');
			}
		}

		function format_date($date, $format = "d.m.Y") {
			return date_format(date_create($date), $format);
		}

 ?>
