<?php

	if(!isset($_GET['function'])){
    	die('Some Error occured.');
	}

	function GetQuestions()
	{	
		$TestNo = $_GET['TestNo'];
		$query = "SELECT que.que, que.Type, ans.aAnswer, ans.bAnswer, ans.cAnswer, ans.dAnswer FROM `que` INNER JOIN `ans` ON que.queNo = ans.queNo WHERE que.TestNo = '$TestNo'";
		$result = $this->db->select($query);
		$data = array();
		while($row = $result->fetch_assoc()){
			$data[] = $row;
		}
		$data = json_encode($data);
		echo $data;
		echo $_GET['jsonQuestions'].'('.$data.')';
	}	
	
	if(function_exists($_GET['function'])){
		$_GET['function']();
	}

?>