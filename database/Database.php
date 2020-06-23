<?php

			namespace App\Database;

			class Database {

	       public $pdo;

	        public function __construct() {
	            $this->connect();
	        }

	        public function connect() {
						$config = $GLOBALS['config']['database'];

	           try {
	            $this->pdo =  new \PDO($config['rdms'] . ":host=" . $config['host'] . ";dbname=" . $config['db_name'],  $config['user'], $config['password']);
							$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	           } catch (Exception $e) {
	               $e->getMessage();
	           }
	        }

		}


 ?>
