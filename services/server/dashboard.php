<?php 
require('../config/database.php');
class dashboard
{
    
    public function doViewName(){
        return self::getName();
    }
    public function doAddSubNotes($title, $description){
        return self::addSubNotes($title, $description);
    }
    public function doViewSubNotes(){
        return self::getSubNotes();
    }

    // Add Subject Notes Data
    private function addSubNotes($title, $description){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->addSubNotesQuery());
                $stmt->execute(array($this->getId(),$title, $description, 
                $this->getCurrentDate(), $this->getCurrentDate()));
                $result = $stmt->fetch();
                if(!$result){
                    return "addedNotes";
                }else{
                    return "failedNotes";
                }
            }else{
                return 'failedConnection';
            }
        }catch(PDOException $error){
            return $error . "connectionErrors";
        }
    }
    // Get the Subject Notes Data
    private function getSubNotes(){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->getSubNotesQuery());
                $stmt->execute(array($this->getId()));
                $result = $stmt->fetchAll();
                return json_encode($result);
            }else{
                return 'failedConnection';
            }
        }catch(PDOException $error){
            return $error . "connectionError";
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
            return $error . "connectionError";
        }
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
            return $error . "connectionError";
        }
    }
    private function getCurrentDate(){
        return date("Y/m/d");
    }
    private function getNameQuery(){
        return "SELECT * FROM `tbl_user` WHERE `email` = ? AND `password` = ?";
    }
    private function addSubNotesQuery(){
        return "INSERT INTO `tbl_sub_notes` (`user_id`, `title`, `description`, `created_date`, `updated_date`) 
        VALUES (?,?,?,?,?)";
    }
    private function getSubNotesQuery(){
        return "SELECT * FROM `tbl_sub_notes` WHERE user_id = ?";
    }
}
?>