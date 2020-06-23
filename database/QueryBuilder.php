<?php
namespace App\Database;
use \App\Database\QueryBuilder;

 abstract class QueryBuilder extends Database {


	public function find_by_id($id) {
		$stm = $this->pdo->prepare('SELECT * FROM ' . static::$table_name . ' WHERE id = ' . $id . ' LIMIT 1');

		if($stm->execute()) {
			 $result = $stm->fetchAll(\PDO::FETCH_CLASS, get_called_class());
			 if(!empty($result)) {
				 return $result[0];
			 }
		}
	 }



	public function create(array $data) {
		$stm = $this->pdo->prepare('INSERT INTO ' . static::$table_name . '(' . $this->get_columns($data) . ')' . ' VALUES ( ' . $this->get_placeholders($data) . ')');
		$result = $stm->execute($this->get_values($data));
		return $result;
	}


	public function all() {
		$stm = $this->pdo->prepare('SELECT * FROM ' . static::$table_name);
		$stm->execute();
		return $stm->fetchAll(\PDO::FETCH_CLASS, get_called_class());

	}

  public function findByValue($column, $value) {
    $stm = $this->pdo->prepare('SELECT * FROM ' . static::$table_name . ' WHERE ' . $column . ' = ' . $value);
		$stm->execute();
    return $stm->fetchAll(\PDO::FETCH_CLASS, get_called_class());

  }

  public function findAndSort($sortBy, $direction) {
    $stm = $this->pdo->prepare('SELECT * FROM ' . static::$table_name . ' ORDER BY ' . $sortBy . ' ' . $direction);
    $stm->execute();
    return $stm->fetchAll(\PDO::FETCH_CLASS, get_called_class());
  }

	private function get_columns($data) {
		$columns = join(',',  array_keys($data));
		return $columns;
	}



	private function get_values($data) {
		return array_values($data);
	}


	private function get_placeholders($data) {
		$placeholders = [];
		for($i = 0;  $i < count($data); $i++) {
			$placeholders[] = '?';
		}
		$placeholders = join(',', $placeholders);
		return $placeholders;
	}

}






?>
