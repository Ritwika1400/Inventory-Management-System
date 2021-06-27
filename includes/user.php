<?php
/**
 * User Class for account creation and login purpose
 */
class User
{
    private $con;
    function __construct()
    {
        include_once("../database/db.php");
        $db = new Database();
        $this->con = $db->connect();
    }

    //check whether user is already registered or not

    private function emailExist($email){
        $pre_stmt = $this->con->prepare("SELECT id FROM user WHERE email = ? ");
        $pre_stmt->bind_param("s",$email);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        if($result->num_rows > 0){
            return 1;
        }else{
            return 0;
        }
    }
    public function createUserAccount($username,$email,$password,$usertype){
        //To protect your application from sql attack you can use 
        //prepares statement
        if( $this->emailExist($email) ){
            echo "EMAIL_ALREADY_EXISTS";
        }else{
            $pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
            $date = date("Y-m-d");
            $notes = "";
            $pre_stmt = $this->con->prepare("INSERT INTO `user`(`username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) 
            VALUES (?,?,?,?,?,?,?)");
            $pre_stmt->bind_param("sssssss",$username,$email,$pass_hash,$usertype,$date,$date,$notes);
            $result = $pre_stmt->execute() or die($this->con->error);
            if($result){
                return $this->con->insert_id;
            }else{
                return "SOME_ERROR";
            }
        }
    }

    public function userLogin($email,$password){
        $pre_stmt = $this->con->prepare("SELECT id,username,password,last_login,usertype FROM user WHERE email = ?");
        $pre_stmt->bind_param("s",$email);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        if($result->num_rows < 1){
            return "NOT_REGISTERED";
        }else{
            $row = $result->fetch_assoc();
            if(password_verify($password,$row["password"])){
                $_SESSION["userid"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["last_login"] = $row["last_login"];
                $_SESSION["usertype"] = $row["usertype"];
                //updating user last login time
                $last_login = date("Y-m-d h:m:s");
                $pre_stmt = $this->con->prepare("UPDATE user SET last_login = ? WHERE email = ?"); 
                $pre_stmt->bind_param("ss",$last_login,$email);
                $result = $pre_stmt->execute() or die($this->con->error);
                if($result){
                    return 1;
                }else{
                    return 0;
                }
            }else{
                return "PASSWORD_NOT_MATCHED";
            }
        }
    }

    public function update_record($table,$where,$fields){
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			// id = '5' AND m_name = 'something'
			$condition .= $key . "='" . $value . "' AND ";
		}
		$condition = substr($condition, 0, -5);
		foreach ($fields as $key => $value) {
			//UPDATE table SET m_name = '' , qty = '' WHERE id = '';
			$sql .= $key . "='".$value."', ";
		}
		$sql = substr($sql, 0,-2);
		$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
		if(mysqli_query($this->con,$sql)){
			$_SESSION["username"]=$fields["username"];
            return "UPDATED";
		}
	}
}

//$user = new User();
//echo $user->update_record("user",["id"=>1],["username"=>"Soumi"]);
//$user->createUserAccount("Test","soumi11@gmail.com","1234567890","Admin");

//echo $user->userLogin("soumi11@gmail.com","1234567890");
//echo $_SESSION["username"];
//echo $_SESSION["usertype"];
?>