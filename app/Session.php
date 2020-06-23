<?php

   namespace App;

			class Session {

				public function __construct() {
					session_start();
				}

				public function put($key, $value) {
					$_SESSION[$key] = $value;
				}
				public function has($key) {
					return isset($_SESSION[$key]);
				}
				public function get($key) {
					return $_SESSION[$key];
				}

				public function forget($key) {
					unset($_SESSION[$key]);
				}

			}






 ?>
