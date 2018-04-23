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
					Session::set("userlogin", true);
					header("Location: index.php");
				}
			}else{
				$msg = "<script type='text/javascript'>setTimeout(function () { swal('Warning!', 'Wrong Credentials.', 'warning');}, 500);</script>";
				return $msg;
			}
		}

	}

?>