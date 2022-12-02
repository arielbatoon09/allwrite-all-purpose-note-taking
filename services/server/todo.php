<?php 
require('../config/database.php');
class todo
{
    // Open Method
    public function doAddToDo($title, $description)
    {
        return self::addToDo($title, $description);
    }
    public function doViewToDo()
    {
        return self::getToDo();
    }
    public function doDeleteToDo($boxId)
    {
        return self::deleteToDo($boxId);
    }
    public function doCompleteToDo($boxId)
    {
        return self::completeToDo($boxId);
    }
    public function doSetSearchDisplay($searchInp){
        return self::getSearchDisplay($searchInp);
    }
    /* Subject Notes - Functioanlity - START */
    // Add To-Do Data
    private function addToDo($title, $description){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $status = 'On-Going';
                $stmt = $conn->getConnection()->prepare($this->addToDoQuery());
                $stmt->execute(array($this->getId(),$title, $description, $status,
                $this->getCurrentDate(), $this->getCurrentDate()));
                if($stmt){
                    return "addedToDo";
                }else{
                    return "failedToDo";
                }
            }else{
                return 'failedConnection';
            }
        }catch(PDOException $error){
            return $error . "connectionErrors";
        }
    }
    // Get the To-Do Data
    private function getToDo(){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->getToDoQuery());
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
    // Delete the To-Do Data
    private function deleteToDo($boxId){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->deleteToDoQuery());
                $stmt->execute(array($boxId));
                return 'deletedSuccessfully';
            }else{
                return 'failedConnection';
            }
        }catch(PDOException $error){
            return $error . ": Found Error";
        }
    }
        // Change the To-Do Status
        private function completeToDo($boxId)
        {
            try {
                $conn = new database();
                if ($conn->getStatus()) {
                    $status = "Completed";
                    $stmt = $conn->getConnection()->prepare($this->updateToDoStatusQuery());
                    $stmt->execute(array($status, $this->getCurrentDate(), $boxId));
                    $result = $stmt->fetch();
                    if (!$result) {
                        return "updatedStatusAssignment";
                    } else {
                        return "failedUpdateAssignment";
                    }
                } else {
                    return 'failedConnection';
                }
            } catch (PDOException $error) {
                return $error . "connectionErrors";
            }
        }
    // Search Display for Subject Notes data
    private function getSearchDisplay($searchInp){
        try{
            $conn = new database();
            if($conn->getStatus()){
                $stmt = $conn->getConnection()->prepare($this->getToDoInfoQuery());
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
    //Get Date
    private function getCurrentDate(){
        return date("F j, Y, g:i a");
    }
    //Get User Email and Password Query
    private function getNameQuery(){
        return "SELECT * FROM `tbl_user` WHERE `email` = ? AND `password` = ?";
    }
    /* SUBJECT NOTES QUERY - START */
    private function addToDoQuery(){
        return "INSERT INTO `tbl_todo` (`user_id`, `title`, `description`, `status` , `created_date`, `updated_date`) 
        VALUES (?,?,?,?,?,?)";
    }
    private function getToDoQuery(){
        return "SELECT * FROM `tbl_todo` WHERE user_id = ?";
    }
    private function updateToDoStatusQuery()
    {
        return "UPDATE `tbl_todo` SET `status` = ?, `updated_date` = ? WHERE `id`=?";
    }
    private function getToDoInfoQuery(){
        return "SELECT * FROM `tbl_todo` WHERE `user_id` = ? AND `title` = ?";
    }
    private function deleteToDoQuery(){
        return "DELETE FROM `tbl_todo` WHERE `id` = ?";
    }
    /* SUBJECT NOTES QUERY - END */
}
?>