<?php
	class Service{

		public $dbh;

		public function connect(){
			//   $servername="localhost";
			//    $dbname = "sci";
			//    $username = "root";
			//    $password = "";

		
            $servername = '213.171.200.27';
            $username = "cryogene";
            $password = "Cry@0987";
            $dbname= "cryogene";
			$this->dbh=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
			
		}

		//disconnect from database


	
		public function disconnect(){
			$this->dbh=null;
		}

        public function login($username,$password){
            $this->connect();
			$sql="SELECT * FROM users where username=:username AND `password`=:pass";
			$stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':username',$username);
            $stmt->bindParam(':pass',$password);
			$stmt->execute();
			$checked = $stmt->fetch();
			$this->disconnect();
			return $checked;
        }
		public function insertfile($file){
            $this->connect();
			$sql="INSERT INTO files VALUES (null,:username)";
			$stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':username',$file);
            // $stmt->bindParam(':pass',$password);
			$stmt->execute();
			$checked = $stmt->fetch();
			$this->disconnect();
			return $checked;
        }
		public function getfiles(){
            $this->connect();
			$sql="SELECT * FROM files";
			$stmt = $this->dbh->prepare($sql);
            // $stmt->bindParam(':username',$file);
            // $stmt->bindParam(':pass',$password);
			$stmt->execute();
			$checked = $stmt->fetchAll();
			$this->disconnect();
			return $checked;
        }
	
    }



