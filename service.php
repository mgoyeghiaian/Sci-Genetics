<?php
	class Service{

		public $dbh;

		public function connect(){
			//   $servername="localhost";
			//    $dbname = "sci";
			//    $username = "root";
			//    $password = "";

		
            $servername = '213.171.200.25';
            $username = "adminSCI";
            $password = "SCI@sci123";
            $dbname= "SCIgenetics";
			$this->dbh=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
			
		}

		//disconnect from database


	
		public function disconnect(){
			$this->dbh=null;
		}

        public function login($username,$password){
            $this->connect();
			$sql="SELECT * FROM sciusers where username=:username AND `password`=:pass";
			$stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':username',$username);
            $stmt->bindParam(':pass',$password);
			$stmt->execute();
			$checked = $stmt->fetch();
			$this->disconnect();
			return $checked;
        }

		function getrate(){
			$this->connect();
			$sql = "SELECT * FROM rate Where id=1";
			$stm = $this->dbh->prepare($sql);
			$stm->execute();
			$rate = $stm->fetch();
			$this->disconnect();
			return $rate;
		}

		function changerate($x){
			$this->connect();
			$sql = "UPDATE rate SET rate=".$x." Where id=1";
			$stm = $this->dbh->prepare($sql);
			$stm->execute();
			$rate = $stm->fetch();
			$this->disconnect();
			return $rate;
		}
		function insertinfo($arr){
			// die(print_r($arr));
			$this->connect();
			$sql = "INSERT INTO info(id,prefix,client,`location`,email,mobile,test,amountusd,chargeusd,rate,amountaed,document,`status`,username,`password`) VALUES(null,:prefix,:client,:loc,:email,:mobile,:test,:amountusd,:chargeusd,:rate,:amountaed,NULL,0,:user,:pas)";
			$stm = $this->dbh->prepare($sql);
			$name = $arr['firstname'].' '.$arr['lastname'];
			// die($name);
			$stm->bindParam(':prefix',$arr['prefix']);
			$stm->bindParam(':client',$name);
			$stm->bindParam(':loc',$arr['inout']);
			$stm->bindParam(':email',$arr['email']);
			$stm->bindParam(':mobile',$arr['mobile']);
			$stm->bindParam(':test',$arr['test']);
			$stm->bindParam(':amountusd',$arr['amount']);
			$stm->bindParam(':chargeusd',$arr['chargeamount']);
			$stm->bindParam(':rate',$arr['rate']);
			$stm->bindParam(':amountaed',$arr['amountaed']);
			$stm->bindParam(':user',$arr['lastname']);
			$stm->bindParam(':pas',$arr['gpas']);
			// die(print_r($stm));
			$stm->execute();
			$rate = $stm->fetch();
			$this->disconnect();
			return $rate;
		}
		function insertcustomer($username,$password){
			// die($password);
			$this->connect();
			$sql = "INSERT INTO customers(id,username,`password`) VALUES(null,:un,:pw)";
			$stm = $this->dbh->prepare($sql);
			// die($name);
			$stm->bindParam(':un',$username);
			$stm->bindParam(':pw',$password);
			$stm->execute();
			$rate = $stm->fetch();
			$this->disconnect();
			return $rate;
		}
		function insertinfodoc($arr,$doc){
			// die(print_r($doc));
			die(print_r($arr));
			$this->connect();
			$sql = "INSERT INTO info(id,prefix,client,`location`,email,mobile,test,amountusd,chargeusd,rate,amountaed,document,`status`,username,`password`) VALUES(null,:prefix,:client,:loc,:email,:mobile,:test,:amountusd,:chargeusd,:rate,:amountaed,:doc,0,:username,:psw)";
			$stm = $this->dbh->prepare($sql);
			$stm->bindParam(':prefix',$arr['prefix']);
			$stm->bindParam(':client',$arr['clientname']);
			$stm->bindParam(':loc',$arr['inout']);
			$stm->bindParam(':email',$arr['email']);
			$stm->bindParam(':mobile',$arr['mobile']);
			$stm->bindParam(':test',$arr['test']);
			$stm->bindParam(':amountusd',$arr['amount']);
			$stm->bindParam(':chargeusd',$arr['chargeusd']);
			$stm->bindParam(':rate',$arr['rate']);
			$stm->bindParam(':amountaed',$arr['amountaed']);
			$stm->bindParam(':doc',$doc['file']['name']);
			$stm->bindParam(':username',$arr['lastname']);
			$stm->bindParam(':psw',$arr['gpas']);
			$stm->execute();
			$rate = $stm->fetch();
			$this->disconnect();
			return $rate;
		}
		function check($username,$password){
			$this->connect();
			$sql = "SELECT * FROM info Where username = :username and `password` = :psw";
			$stm = $this->dbh->prepare($sql);
			$stm->bindParam(':username',$username);
			$stm->bindParam(':psw',$password);
			$stm->execute();
			$rate = $stm->fetch();
			$this->disconnect();
			return $rate;
		}
		function insertCaptured($object,$cid){
			$id = $object->id;
			$serviceType = $object->serviceType;
			$serviceMode = $object->serviceMode;
			$paymentMethodType = $object->customerInfo->paymentMethod->type;
			$merchantCode = $object->merchantInfo->merchantCode;
			$merchantRequestId = $object->merchantInfo->merchantRequestId;
			$merchantOrderId = $object->merchantInfo->merchantOrderId;
			$amountValue = $object->paymentInfo->amount->value;
			$amountCurrency = $object->paymentInfo->amount->currency;
			$noqodiOrderId = $object->paymentInfo->noqodiOrderId;
			$customerReferenceId = $object->paymentInfo->customerReferenceId;
			$customerServiceReferenceId = $object->paymentInfo->customerServiceReferenceId;
			$transactionDate = $object->paymentInfo->transactionDate;
			$settlementDate = $object->paymentInfo->settlementDate;
			$serviceName = $object->paymentInfo->serviceName;
			$status = $object->statusInfo->status;
			$noqodiReferenceId = $object->paymentInfo->transactions[0]->noqodiReferenceId;
			$beneficiaryAcctNumber = $object->paymentInfo->transactions[0]->beneficiaries[0]->beneficiaryAcctNumber;

			// die($beneficiaryAcctNumber);

			$this->connect();
			$sql = "INSERT INTO captured(id,amount,cur,`mcode`,mreq,morder,noqord,noqref,bennum,infoid) VALUES(null,:am,:cur,:mcode,:mreq,:morder,:noqord,:noqref,:bannum,:infoid)";
			$stm = $this->dbh->prepare($sql);
			// die($name);
			$stm->bindParam(':am',$amountValue);
			$stm->bindParam(':cur',$amountCurrency);
			$stm->bindParam(':mcode',$merchantCode);
			$stm->bindParam(':mreq',$merchantRequestId);
			$stm->bindParam(':morder',$merchantOrderId);
			$stm->bindParam(':noqord',$noqodiOrderId);
			$stm->bindParam(':noqref',$noqodiReferenceId);
			$stm->bindParam(':bannum',$beneficiaryAcctNumber);
			$stm->bindParam(':infoid',$cid);
			// die(print_r($stm));
			$stm->execute();
			$rate = $stm->fetch();
			$this->disconnect();
			return $rate;
		}
		function getinfos(){
			$this->connect();
			$sql = "SELECT * FROM captured inner join info on captured.infoid = info.id";
			$stm = $this->dbh->prepare($sql);
			// $stm->bindParam(':username',$username);
			// $stm->bindParam(':psw',$password);
			$stm->execute();
			$rate = $stm->fetchAll();
			$this->disconnect();
			return $rate;
		}
		function getinfoaccinfo($id){
			$this->connect();
			$sql = "SELECT * FROM captured where infoid = :infoid";
			$stm = $this->dbh->prepare($sql);
			$stm->bindParam(':infoid',$id);
			// $stm->bindParam(':psw',$password);
			$stm->execute();
			$rate = $stm->fetch();
			$this->disconnect();
			return $rate;
		}
    }



