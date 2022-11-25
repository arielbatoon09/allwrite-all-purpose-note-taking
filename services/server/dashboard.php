<?php 
require('../config/database.php');
class dashboard
{
    // Open Method
    public function doViewName(){
        return self::getName();
    }
    //Get the User Full Name
    private function getName(){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->getNameQuery());
                $stmt->execute(array($_SESSION['email'], $_SESSION['password']));
                $tmp = null;
                while($row = $stmt->fetch()){
                    $tmp = $row['full_name'];
                }
                return $tmp;
            }else{
                return 'failedConnection';
            }
        }catch(PDOException $error){
            return $error . ": Found Error";
        }
    }
    //Database Query
    //Get User Email and Password Query
    private function getNameQuery(){
        return "SELECT * FROM `tbl_user` WHERE `email` = ? AND `password` = ?";
    }
}
?>