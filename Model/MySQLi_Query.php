<?php

namespace Model;

class MySQLi_Query
{
	//выборка, тут всё ясно

	public function select($link, $query)
	{
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$arr = [];

		while ($row = mysqli_fetch_array($result)) 
			$arr[] = $row;

		return $arr;
	}

	//
	// Вставка строки
	// $table 		- имя таблицы
	// $object 		- ассоциативный массив с парами вида "имя столбца - значение"
	// результат	- идентификатор новой строки
	//

	public function insert($link, $table, $object)
	{
		$columns = [];
		$values = [];

		foreach ($object as $key => $value) {
			$key = mysqli_real_escape_string($link, $key.'');
			$columns[] = $key;

			if($value === NULL) {
				$values[] = 'NULL';
			}
			else {
				$value = mysqli_real_escape_string($link, $value.'');
				$values[] = "'$value'";
			}
		}

		$columns_s = implode(',', $columns);
		$values_s = implode(',', $values);

		$query = "INSERT INTO $table ($columns_s) VALUES ($values_s)";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));

		return mysqli_insert_id();
	}

	//
	// Изменение строк
	// $table 		- имя таблицы
	// $object 		- ассоциативный массив с парами вида "имя столбца - значение"
	// $where		- условие (часть SQL запроса)
	// результат	- число измененных строк
	//	

	public function update($link, $table, $object, $where)
	{
		$sets = [];

		foreach ($object as $key => $value) {
			$key = mysqli_real_escape_string($link, $key.'');
			if($value === NULL) {
				$values[] = 'NULL';
			}
			else {
				$value = mysqli_real_escape_string($link, $value.'');
			}
			$sets[] = "$key='$value'";
		}

		$set_s = implode(',', $sets);
		$query = "UPDATE $table SET $set_s WHERE $where";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));

		return mysqli_affected_rows($result);
	}

	//
	// Удаление строк
	// $table 		- имя таблицы
	// $where		- условие (часть SQL запроса)	
	// результат	- число удаленных строк
	//		

	public function delete($link, $table, $where)
	{
		$query = "DELETE FROM $table WHERE $where";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));

		return mysqli_affected_rows($result);
	}
}