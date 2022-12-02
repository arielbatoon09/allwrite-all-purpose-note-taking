<?php 
require('../config/database.php');
class dashboard
{
    // Open Method
    public function doViewName(){
        return self::getName();
    }
    public function doSubNotesCount(){
        return self::getSubNotesCount();
    }
    public function doAssignmentCount(){
        return self::getAssignmentCount();
    }
    public function doResourcesCount(){
        return self::getResourcesCount();
    }
    public function doToDoCount(){
        return self::getToDoCount();
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
    // Get the total Row of the user
    private function getSubNotesCount(){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->getSubNotesCountQuery());
                $stmt->execute(array($this->getId()));
                $result = $stmt->rowCount();
                return $result;
            }else{
                return 'failedConnection';
            }
        }catch(PDOException $error){
            return $error . ": Found Error";
        }
    }
    private function getAssignmentCount(){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->getAssignmentCountQuery());
                $stmt->execute(array($this->getId()));
                $result = $stmt->rowCount();
                return $result;
            }else{
                return 'failedConnection';
            }
        }catch(PDOException $error){
            return $error . ": Found Error";
        }
    }
    private function getResourcesCount(){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->getResourcesCountQuery());
                $stmt->execute(array($this->getId()));
                $result = $stmt->rowCount();
                return $result;
            }else{
                return 'failedConnection';
            }
        }catch(PDOException $error){
            return $error . ": Found Error";
        }
    }
    private function getToDoCount(){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->getToDoCountQuery());
                $stmt->execute(array($this->getId()));
                $result = $stmt->rowCount();
                return $result;
            }else{
                return 'failedConnection';
            }
        }catch(PDOException $error){
            return $error . ": Found Error";
        }
    }
    // Get the User ID
    private function getId(){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->getNameQuery());
                $stmt->execute(array($_SESSION['email'], $_SESSION['password']));
                $tmp = null;
                while($row = $stmt->fetch()){
                    $tmp = $row['id'];
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
    private function getSubNotesCountQuery(){
        return "SELECT * FROM `tbl_sub_notes` WHERE `user_id` = ?";
    }
    private function getAssignmentCountQuery(){
        return "SELECT * FROM `tbl_assignments` WHERE `user_id` = ?";
    }
    private function getResourcesCountQuery(){
        return "SELECT * FROM `tbl_resources` WHERE `user_id` = ?";
    }
    private function getToDoCountQuery(){
        return "SELECT * FROM `tbl_todo` WHERE `user_id` = ?";
    }
}
?>