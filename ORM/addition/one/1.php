<?php
	class DB
	{


		private $db;

		// Соединение с БД
		public function __construct()
		{
			$conInfo = require 'connect.php';
			$this->db = new PDO('mysql:host=' . $conInfo['host'] . ';dbname=' . $conInfo['dbname'], $conInfo['login'],$conInfo['password']);
		}

		// Операции над БД
		public function query($sql, $params = [])
		{
			// Подготовка запроса
			$stmt = $this->db->prepare($sql);
			
			// bindValue - подставление значений в массив params
			if ( !empty($params) ) {
				foreach ($params as $key => $value) {
					$stmt->bindValue(":$key", $value);
				}
			}
			
			// выполннеие
			$stmt->execute();
			// ответ
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getAll($table, $sql = '', $params = [])
		{
            return  $this->query("SELECT * FROM $table" . $sql, $params);

        }

		public function getRow($table, $sql = '', $params = [])
		{
			$result = $this->query("SELECT * FROM $table" . $sql, $params);
			return $result[0]; 
		}
        public function getCol($table, $col)
        {
            return  $this->query("SELECT $col FROM $table");

        }

	}
	$db = new DB;

	// Получаем и выводим данные
//	echo "<pre>";
//	print_r($db->getAll('otdel'));
//echo "<pre>";
//print_r($db->getRow('otdel'));
//echo "<pre>";
//print_r($db->getCol('otdel', 'title'));




//echo "<pre>";
//print_r($db->getAll('trytry'));


//echo "<pre>";
//print_r($db->getAll('trytry'));


$params = [
	'name' => 'anton',
	'lastname' => 'vostrikov',
];
$db->query('INSERT INTO `trytry` ( name, lastname) VALUES ( :name , :lastname)', $params);


?>

