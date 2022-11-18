<?php
require('../config/database.php');
class authentication
{
    // Request Register
    public function doRegister($fullname, $email, $password, $confirmpass){
        return self::register($fullname, $email, $password, $confirmpass);
    }
    // Request Login
    public function doLogin($email,$password){
        return self::login($email, $password);
    }
    // Register Method
    private function register($fullname, $email, $password, $confirmpass){
        try{
            // validating if the inputs are valid data.
            if($this->checkIfValidRegister($fullname, $email, $password, $confirmpass)){
                //initiate db
                $conn = new database();
                //checking if email is exist
                $checkEmail = $conn->getConnection()->prepare("SELECT email from tbl_user WHERE email = ?");
                $checkEmail->execute([$email]);
                if($checkEmail->rowCount() > 0) {
                    return "emailTaken";
                }else{
                    //verifying password
                    if($password == $confirmpass){
                        if(strlen($password) >= 6 && strlen($password) <= 12 
                        && strlen($confirmpass) >= 6 && strlen($confirmpass) <= 12){
                            if($conn->getStatus()){
                                $stmt = $conn->getConnection()->prepare($this->registerQuery());
                                $stmt->execute(array($fullname,$email,md5($password),
                                1,1,$this->getCurrentDate(),$this->getCurrentDate()));
                                return "successCreateAccount";
                            }else{
                                return "failedCreateAccount";
                            }
                        }else{
                            return "passwordNotMeetRequirements";
                        }
                    }else{
                        //return error if the password and confirmpass doesn't match.
                        return "passwordNotMatch";
                    }
                }
            }else{
                //return invalid if the credentials is wrong...
                echo "invalidCredentials";
            }
        }catch(PDOException $error){
            return $error."connectionError";
        }
    }
    // Login Method

    private function login($email, $password)
    {
        try {
            $conn = new database();
            if($this->checkIfValidLogin($email, $password)){
                $conn = new database();
                $tmpPass = md5($password);
                if($conn->getStatus()){
                    $tmpPass = md5($password);
                    $stmt = $conn->getConnection()->prepare($this->loginQuery());
                    $stmt->execute(array($email, $tmpPass));
                    $result = $stmt->fetch();
                    if ($result) {
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $tmpPass;
                        $_SESSION['isLoggedIn'] = 'success';
                        return $_SESSION['isLoggedIn'];
                    }else{
                        return "failedLogin";
                    }
                }else{
                    return 'failedConnection';
                }
            }else{
                return 'invalidCredentials';
            }
        }catch (PDOException $error) {
            return $error . "connectionError";
        }
    }
    // Data validation for registration
    private function checkIfValidRegister($fullname, $email, $password, $confirmpass){
        // check if the needed data is being filled.
        if($fullname != "" && $email != "" && $password != "" && $confirmpass != ""){
            //check if it's a valid email or not...
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    // Data validation for login
    private function checkIfValidLogin($email, $password){
        if($email != "" && $password != ""){
            //check if it's a valid email or not...
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    // Get the current date
    private function getCurrentDate(){
        return date("Y/m/d");
    }
    // Queries
    private function registerQuery(){
        return "INSERT INTO `tbl_user` (`full_name`, `email`, `password`, `policy`, `flag`, `created_date`, `updated_date`) 
        VALUES (?,?,?,?,?,?,?)";
    }
    private function loginQuery(){
        return "SELECT * FROM `tbl_user` WHERE `email` = ? AND `password` = ?";
    }
}
