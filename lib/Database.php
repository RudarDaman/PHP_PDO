<?php
	
	class Database
	{
		private $hostdb = "localhost";
		private $userdb = "root";
		private $passdb = "";
		private $namedb = "lq";
		public $pdo;

		public function __construct()
		{
			if(!isset($this->pdo)){
				try{
					$link = new PDO("mysql:host=".$this->hostdb.";dbname=".$this->namedb, $this->userdb, $this->passdb);
					$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$link->exec("SET CHARACTER SET utf8");
					$this->pdo = $link;
				}catch(PDOException $e){
					die("Failed to connect to Databse. ".$e->getMessage());
				}
			}
			$this->link = new mysqli($this->hostdb, $this->userdb, $this->passdb, $this->namedb);
			if(!$this->link){
				$this->error ="Connection fail".$this->link->connect_error;
				return false;
			}
		}

		public function select($query){
			$result = $this->link->query($query) or die($this->link->error.__LINE__);
			if($result->num_rows > 0){
				return $result;
			} else {
				return false;
			}
		}
			
		// Insert data
		public function insert($query){
			$insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
			if($insert_row){
				return $insert_row;
			} else {
				return false;
			}
	  	}
		  
	    // Update data
	  	public function update($query){
			$update_row = $this->link->query($query) or die($this->link->error.__LINE__);
			if($update_row){
				return $update_row;
			} else {
				return false;
			}
	  	}
		  
	  	//Delete data
		public function delete($query){
			$delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
			if($delete_row){
				return $delete_row;
			} else {
				return false;
			}
	  	}
	}

?>