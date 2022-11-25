<?php 
require('../config/database.php');
class dashboard
{
    // Open Method
    public function doAddSubNotes($title, $description){
        return self::addSubNotes($title, $description);
    }
    public function doViewSubNotes(){
        return self::getSubNotes();
    }
    public function doDisplaySubNotes(){
        return self::getSubNotesDisplay();
    }
    public function doDeleteSubNotes($boxId){
        return self::deleteSubNotes($boxId);
    }
    public function doUpdateSubNotes($newTitle, $newDescription){
        return self::updateSubNotes($newTitle, $newDescription);
    }
    public function doSetSessionBoxId($boxId){
        return self::setSessionBoxId($boxId);
    }
    public function doSetSearchDisplay($searchInp){
        return self::getSearchDisplay($searchInp);
    }
    /* Subject Notes - Functioanlity - START */
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
            return $error . ": Found Error";
        }
    }
    private function getSubNotesDisplay(){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->getIdSubNotesQuery());
                $stmt->execute(array($_SESSION['setBoxId']));
                $result = $stmt->fetchAll();
                return json_encode($result);
            }else{
                return 'failedConnection';
            }
        }catch(PDOException $error){
            return $error . ": Found Error";
        }
    }
    // Delete the Subject Notes Data
    private function deleteSubNotes($boxId){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->deleteSubNotesQuery());
                $stmt->execute(array($boxId));
                $result = $stmt->rowCount();
                return $result;
            }else{
                return 'failedConnection';
            }
        }catch(PDOException $error){
            return $error . ": Found Error";
        }
    }
    // Update the Subject Notes data
    private function updateSubNotes($newTitle, $newDescription){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->updateSubNotesQuery());
                $stmt->execute(array($newTitle, $newDescription, $this->getCurrentDate(), $_SESSION['setBoxId']));
                return 'updatedSuccess';
            }else{
                return 'failedConnection';
            }
        }catch(PDOException $error){
            return $error . ": Found Error";
        }
    }
    // Search Display for Subject Notes data
    private function getSearchDisplay($searchInp){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->getSubNotesInfoQuery());
                $stmt->execute(array($this->getId(), $searchInp));
                $result = $stmt->fetchAll();
                $tmp = null;
                if($result){
                    $tmp = $result;
                    return json_encode($tmp);
                }else{
                    return 'Not Found Data';
                }
            }else{
                return 'failedConnection';
            }

        }catch(PDOException $error){
            return $error . ": Found Error";
        }
    }
    /* Subject Notes - Functioanlity - END */
    
    //Set BoxID for data fetching purposes.
    private function setSessionBoxId($boxId){
        try{
            $conn = new database();
            if($conn->getStatus()){
                return $_SESSION['setBoxId'] = $boxId;
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
    //Get the User Full Name
    //Database Query
    //Get Date
    private function getCurrentDate(){
        return date("F j, Y, g:i a");
    }
    //Get User Email and Password Query
    private function getNameQuery(){
        return "SELECT * FROM `tbl_user` WHERE `email` = ? AND `password` = ?";
    }
    /* SUBJECT NOTES QUERY - START */
    private function addSubNotesQuery(){
        return "INSERT INTO `tbl_sub_notes` (`user_id`, `title`, `description`, `created_date`, `updated_date`) 
        VALUES (?,?,?,?,?)";
    }
    private function getSubNotesQuery(){
        return "SELECT * FROM `tbl_sub_notes` WHERE user_id = ?";
    }
    private function getIdSubNotesQuery(){
        return "SELECT * FROM `tbl_sub_notes` WHERE `id` = ?";
    }
    private function getSubNotesInfoQuery(){
        return "SELECT * FROM `tbl_sub_notes` WHERE `user_id` = ? AND `title` = ?";
    }
    private function deleteSubNotesQuery(){
        return "DELETE FROM `tbl_sub_notes` WHERE `id` = ?";
    }
    private function updateSubNotesQuery(){
        return "UPDATE `tbl_sub_notes` SET `title` = ?, `description` = ?, `updated_date` = ? WHERE `id`=?";
    }
    /* SUBJECT NOTES QUERY - END */
}
?>