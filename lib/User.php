<?php
	
	include_once 'Session.php';
	include_once 'Database.php';

	class User
	{
		private $db;
		public function __construct()
		{
			$this->db = new Database();
		}

		public function emailChecK($email){
			$sql = "SELECT Email FROM login where Email = :email";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':email', $email);
			$query->execute();
			if($query->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function emailVerify($data){
			if($data == 1){
				return true;
			}else{
				return false;
			}
		}

		public function statusCheck($data)
		{
			if($data == 1){
				return true;
			}else{
				return false;
			}
		}

		public function getLoginUser($email, $password){
			$sql = "SELECT * FROM login where Email = :email AND Password = :password LIMIT 1";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':email', $email);
			$query->bindValue(':password', $password);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}

		public function userLogin($data){
			$email    = $data['email'];
			$password = md5($data['password']);

			$chk_email = $this->emailCheck($email);

			// if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			// 	$msg = "<script type='text/javascript'>setTimeout(function () { swal('Warning!', 'Email is not valid.', 'warning');}, 500);</script>";
			// 	return $msg;
			// }

			if($chk_email == false){
				$msg = "<script type='text/javascript'>setTimeout(function () { swal('Warning!', 'This email address not exists.', 'warning');}, 500);</script>";
				return $msg;
			}

			$result = $this->getLoginUser($email,$password);
			if ($result) {
				$chk_status = $this->statusCheck($result->status);
				$verify_email = $this->emailVerify($result->Mail_Verify);
				if($verify_email){
					Session::init();
					Session::set("id", $result->SNo);
					Session::set("name", $result->Name);
					Session::set("email", $result->Email); 
					Session::set("type", $result->Type); 
					Session::set("loginmsg", "<script type='text/javascript'>setTimeout(function () { swal('Welcome ".$result->Name."!', 'You have successfully logged in.', 'success');}, 500);</script>");
					if($result->Type == 'a'){
						Session::set("adminlogin", true);
						header("Location: admin.php");
					}
					else{
						if ($chk_status) {
							Session::set("userlogin", true);
							header("Location: index.php");
						}
						else{
							$msg = "<script type='text/javascript'>setTimeout(function () { swal('User disabled', 'Please contact administrator.', 'warning');}, 500);</script>";
							return $msg;
						}
					}
				}
				else{
					$msg = "<script type='text/javascript'>setTimeout(function () { swal('Warning!', 'Please verify your email id first.', 'warning');}, 500);</script>";
					return $msg;
				}
			}else{
				$msg = "<script type='text/javascript'>setTimeout(function () { swal('Warning!', 'Wrong Credentials.', 'warning');}, 500);</script>";
				return $msg;
			}
		}

		public function getAllTestSeries()
		{
			$query = "SELECT * FROM `test_category` WHERE status=1";
			$result = $this->db->select($query);
			return $result;
		}

		public function getTestCount($name)
		{
			$len = strlen($name);
			$query = "SELECT COUNT(*) as count FROM `test` WHERE RIGHT(Name, '$len')='$name'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAllTests($name)
		{
			$len = strlen($name);
			$query = "SELECT * FROM `test` WHERE RIGHT(Name, '$len')='$name'";
			$result = $this->db->select($query);
			return $result;
		}

		public function prepareQue($TestNo)
		{
			$query = "SELECT que.queNo,que.TestNo,que.que, que.Type, ans.aAnswer, ans.bAnswer, ans.cAnswer, ans.dAnswer FROM `que` INNER JOIN `ans` ON que.queNo = ans.queNo WHERE que.TestNo = '$TestNo'";
			$result = $this->db->select($query);
			$data = array();
			while($row = $result->fetch_assoc()){
				$data[] = $row;
			}
			$data = json_encode($data);
			$answer = '{}';
			$answer = json_encode($answer);
			echo "<script text='javascript'>localStorage.setItem('question', JSON.stringify(".$data."));</script>";
			echo "<script text='javascript'>localStorage.setItem('answer', JSON.stringify(".$answer."));</script>";
		}

	}

?>