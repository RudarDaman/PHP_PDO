<?php
	
	include_once 'Session.php';
	include_once 'Database.php';

	class Admin
	{
		private $db;
		public function __construct()
		{
			$this->db = new Database();
		}

		public function getAllUsers()
		{
			$sql = "SELECT * FROM login where Type = 'u'";
			$result = $this->db->select($sql);
			return $result;
		}

		public function getAllTests()
		{
			$sql = "SELECT * FROM test where 1";
			$result = $this->db->select($sql);
			return $result;
		}

		public function getAllTestCat()
		{
			$sql = "SELECT * FROM test_category where 1";
			$result = $this->db->select($sql);
			return $result;
		}

		public function DisableUser($userId, $userName)
		{		
			$query = "UPDATE login SET status = '0' WHERE SNo = '$userId'";
			$result = $this->db->update($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','User Disabled ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', ' User Not Disabled ', 'warning');}, 500);</script>";
			}
		}

		public function EnableUser($userId, $userName)
		{		
			$query = "UPDATE login SET status = '1' WHERE SNo = '$userId'";
			$result = $this->db->update($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','User Enabled ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', ' User Not Enabled ', 'warning');}, 500);</script>";
			}
		}

		public function DeleteUser($userId, $userName)
		{		
			$query = "DELETE FROM login WHERE SNo = '$userId'";
			$result = $this->db->delete($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','User Deleted ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', ' User Not Deleted ', 'warning');}, 500);</script>";
			}
		}

		public function addCategory($data)
		{
			$CategoryName = $data['CategoryName'];
			$timestamp = date("Y-m-d H:i:s");
			$query = "INSERT IGNORE INTO test_category (`Id`, `Name`, `Timestamp`) VALUES ('','$CategoryName','$timestamp')";
			$result = $this->db->insert($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','Category Inserted. ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', 'Category Not Inserted.', 'warning');}, 500);</script>";
			}
		}

		public function editCategory($data)
		{
			$CategoryName = $data['CategoryName'];
			$id = $data['Id'];
			$timestamp = date("Y-m-d H:i:s");
			$query = "UPDATE test_category SET `Name`='$CategoryName' WHERE `Id`='$id'";
			$result = $this->db->update($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','Category Updated. ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', 'Category Not Updated.', 'warning');}, 500);</script>";
			}
		}

		public function DisableCategory($catId)
		{		
			$query = "UPDATE test_category SET status = '0' WHERE Id = '$catId'";
			$result = $this->db->update($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','Category Disabled ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', ' Category Not Disabled ', 'warning');}, 500);</script>";
			}
		}

		public function EnableCategory($catId)
		{		
			$query = "UPDATE test_category SET status = '1' WHERE Id = '$catId'";
			$result = $this->db->update($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','Category Enabled ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', ' Category Not Enabled ', 'warning');}, 500);</script>";
			}
		}

		public function addTest($data)
		{
			$TestName = $data['TestName'];
			$TestCategory = $data['TestCategory'];
			$TestNameCat = $TestName."@".$TestCategory;
			$TestDuration = $data['TestDuration'];
			$timestamp = date("Y-m-d H:i:s");
			$query = "INSERT IGNORE INTO `test`(`TestNo`, `Name`, `Duration`, `Type`, `Created`, `status`) VALUES ('','$TestNameCat','$TestDuration',0,'$timestamp',0)";
			$result = $this->db->insert($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','Test Added. ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', 'Test Not Added.', 'warning');}, 500);</script>";
			}
		}

		public function editTest($data)
		{
			$TestName = $data['TestName'];
			$TestCategory = $data['TestCategory'];
			$TestNameCat = $TestName."@".$TestCategory;
			$TestDuration = $data['TestDuration'];
			$TestNo = $data['TestNo'];
			$timestamp = date("Y-m-d H:i:s");
			$query = "UPDATE `test` SET `Name`='$TestNameCat',`Duration`='$TestDuration',`Created`='$timestamp' WHERE `TestNo`='$TestNo'";
			$result = $this->db->update($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','Test Details Updated. ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', 'Test Details Not Updated.', 'warning');}, 500);</script>";
			}
		}

		public function DisableTest($data)
		{		
			$TestNo = $data['TestNo'];
			$query = "UPDATE test SET status = '0' WHERE TestNo = '$TestNo'";
			$result = $this->db->update($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','Test Disabled ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', ' Test Not Disabled ', 'warning');}, 500);</script>";
			}
		}

		public function EnableTest($data)
		{		
			$TestNo = $data['TestNo'];
			$query = "UPDATE test SET status = '1' WHERE TestNo = '$TestNo'";
			$result = $this->db->update($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','Test Enabled ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', ' Test Not Enabled ', 'warning');}, 500);</script>";
			}
		}

		public function PrimeTest($data)
		{		
			$TestNo = $data['TestNo'];
			$query = "UPDATE `test` SET `Type` = '1' WHERE TestNo = '$TestNo'";
			echo $query;
			$result = $this->db->update($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','Test Type Changed To Premium ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', ' Test Type Not Changed ', 'warning');}, 500);</script>";
			}
		}

		public function FreeTest($data)
		{		
			$TestNo = $data['TestNo'];
			$query = "UPDATE `test` SET `Type` = '0' WHERE TestNo = '$TestNo'";
			$result = $this->db->update($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','Test Type Changed To Free ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', ' Test Type Not Changed ', 'warning');}, 500);</script>";
			}
		}

		public function addQue($data)
		{		
			$TestId = $data['TestId'];
			$Question = $data['Question'];
			$aAnswer = $data['aAnswer'];
			$bAnswer = $data['bAnswer'];
			$cAnswer = $data['cAnswer'];
			$dAnswer = $data['dAnswer'];
			$answers = array($aAnswer,$bAnswer,$cAnswer,$dAnswer);
			$correctAnswer = (int)$data['correctAnswer']-1;
			$QueCategory = $data['QueCategory'];
			$query = "INSERT INTO `que`(`id`, `TestNo`, `quesNo`, `que`, `Type`) VALUES ('','$TestId','$QuestionId','$Question','$QueCategory')";
			$result1 = $this->db->update($query);
			$QuestionId = $data['QuestionId'];
			$query = "INSERT INTO `ans`(`id`, `quesNo`, `correct`, `ans`) VALUES ('','$QuestionId','0','$aAnswer')";
			$result2 = $this->db->update($query);
			$query = "INSERT INTO `ans`(`id`, `quesNo`, `correct`, `ans`) VALUES ('','$QuestionId','0','$bAnswer')";
			$result3 = $this->db->update($query);
			$query = "INSERT INTO `ans`(`id`, `quesNo`, `correct`, `ans`) VALUES ('','$QuestionId','0','$cAnswer')";
			$result4 = $this->db->update($query);
			$query = "INSERT INTO `ans`(`id`, `quesNo`, `correct`, `ans`) VALUES ('','$QuestionId','0','$dAnswer')";
			$result5 = $this->db->update($query);
			$query = "UPDATE `ans` SET `correct`='1' WHERE `quesNo`='$QuestionId' and `ans`='$answers[$correctAnswer]'";
			$result6 = $this->db->update($query);

			if ($result1 && $result2 && $result3 && $result4 && $result5 && $result6) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','Question Added Successfu;;y', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', 'Question Not Added  ', 'warning');}, 500);</script>";
			}
		}


		public function getAllTestQues($TestNo)
		{		
			$query = "select * from `que` WHERE TestNo = '$TestNo'";
			$result = $this->db->select($query);
			if ($result) {
				return "<script type='text/javascript'>setTimeout(function () { swal('Successful...','Test Type Changed To Free ', 'success');}, 500);</script>";
			}
			else{
				return "<script type='text/javascript'>setTimeout(function () { swal('Error... ', ' Test Type Not Changed ', 'warning');}, 500);</script>";
			}
		}

	}

?>