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
    // Request Change Password
    public function doChangePassword($oldpassword, $newpassword, $confirmpassword){
        return self::changePassword($oldpassword, $newpassword, $confirmpassword);
    }
    // Request to SET PIN Code
    public function doSetPinCode($pincode, $confirmpincode){
        return self::setPinCode($pincode, $confirmpincode);
    }
    // Request Retrieve Password
    public function doRetrievePassword($email, $pincode, $newpassword){
        return self::retrievePassword($email, $pincode, $newpassword);
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
    // Change Password Method
    private function changePassword($oldpassword, $newpassword, $confirmpassword)
    {
        try {
            $conn = new database();
            if($this->checkIfValidChangePassword($oldpassword, $newpassword, $confirmpassword)){
                $conn = new database();
                if($conn->getStatus()){
                    $tmpOldPass = md5($oldpassword);
                    if($_SESSION['password'] == $tmpOldPass){
                        if($newpassword == $confirmpassword){
                            if(strlen($newpassword) >= 6 && strlen($newpassword) <= 12 &&
                            strlen($confirmpassword) >= 6 && strlen($confirmpassword) <= 12){
                                $stmt = $conn->getConnection()->prepare($this->getChangepassQuery());
                                $stmt->execute(array($_SESSION['email'], $_SESSION['password']));
                                $result = $stmt->fetch();
                                if ($result) {
                                    $stmt2 = $conn->getConnection()->prepare($this->setChangepassQuery());
                                    $stmt2->execute(array(md5($newpassword), $_SESSION['email']));
                                    $_SESSION['password'] = md5($newpassword);
                                    return 'changedPassword';
                                }else{
                                    return "failedLogin";
                                }
                            }else{
                                return 'passwordNotMeetRequirements';
                            }
                        }else{
                            return 'PasswordDoesNotMatch';
                        }
                    }else{
                        return 'PasswordNotFound';
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
    // Set PIN Code
    private function setPinCode($pincode, $confirmpincode)
    {
        try {
            $conn = new database();
            if($this->checkIfValidPin($pincode, $confirmpincode)){
                $conn = new database();
                if($conn->getStatus()){
                    if($pincode == $confirmpincode){
                        if(strlen($pincode) == 6){
                            $stmt = $conn->getConnection()->prepare($this->loginQuery());
                            $stmt->execute(array($_SESSION['email'], $_SESSION['password']));
                            $result = $stmt->fetch();
                            if ($result) {
                                $stmt2 = $conn->getConnection()->prepare($this->setPINQuery());
                                $stmt2->execute(array($pincode, $_SESSION['email']));
                                return 'setPinSuccess';
                            }else{
                                return "failedSetPin";
                            }
                        }else{
                            return 'pinCodeDoesNotMeetRequirements';
                        }
                    }else{
                        return 'pinCodeDoesNotMatch';
                    }
                }else{
                    return 'failedConnection';
                }
            }else{
                return 'invalidPIN';
            }
        }catch (PDOException $error) {
            return $error . "connectionError";
        }
    }
    // Retrieve Password
    private function retrievePassword($email, $pincode, $newpassword)
    {
        try {
            $conn = new database();
            if($this->checkIfValidRetrieve($email, $pincode, $newpassword)){
                $conn = new database();
                if($conn->getStatus()){
                    if(strlen($newpassword) >= 6 && strlen($newpassword) <= 6){
                        $tmpPass = md5($newpassword);
                        $stmt = $conn->getConnection()->prepare($this->getEmailPinQuery());
                        $stmt->execute(array($email, $pincode));
                        $result = $stmt->fetch();
                        if ($result) {
                            $stmt2 = $conn->getConnection()->prepare($this->setChangepassQuery());
                            $stmt2->execute(array($tmpPass, $email));
                            return 'retrieveSuccessfully';
                        }else{
                            return "accountNotFound";
                        }
                    }else{
                        return 'passwordNotMeetRequirements';
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
    // Data validation for Change Password
    private function checkIfValidChangePassword($oldpassword, $newpassword, $confirmpassword){
        if($oldpassword != "" && $newpassword != "" && $confirmpassword){
            return true;
        }else{
            return false;
        }
    }
    // Data validation for login
    private function checkIfValidPin($pincode, $confirmpincode){
        if($pincode != "" && $confirmpincode != ""){
            if (!filter_var($pincode, FILTER_VALIDATE_INT) === false 
            && !filter_var($confirmpincode, FILTER_VALIDATE_INT) === false) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    // Data validation for registration
    private function checkIfValidRetrieve($email, $pincode, $newpassword){
        // check if the needed data is being filled.
        if($email != "" && $pincode != "" && $newpassword != ""){
            //check if it's a valid email or not...
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false 
            && !filter_var($pincode, FILTER_VALIDATE_INT) === false){
                return true;
            }else{
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
    private function getChangepassQuery(){
        return "SELECT * FROM `tbl_user` WHERE `email` = ? AND `password` = ?";
    }
    private function setChangepassQuery(){
        return "UPDATE `tbl_user` SET `password` = ? WHERE `email` = ?";
    }
    private function setPINQuery(){
        return "UPDATE `tbl_user` SET `pin` = ? WHERE `email` = ?";
    }
    private function getEmailPinQuery(){
        return "SELECT * FROM `tbl_user` WHERE `email` = ? AND `pin` = ?";
    }
}
