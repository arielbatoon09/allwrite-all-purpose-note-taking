<?php
require('../config/database.php');
class assignment
{
    // Open Method
    public function doAddAssignment($title, $description, $duedate)
    {
        return self::addAssignment($title, $description, $duedate);
    }
    public function doCompleteAssignment($boxId)
    {
        return self::completeAssignment($boxId);
    }
    public function doViewAssignment()
    {
        return self::getAssignment();
    }
    public function doDeleteAssignment($boxId)
    {
        return self::deleteAssignment($boxId);
    }
    public function doSetSearchDisplay($searchInp)
    {
        return self::getSearchDisplay($searchInp);
    }
    /* Assignment - Functionality - START */
    // Add Assignment Data
    private function addAssignment($title, $description, $duedate)
    {
        try {
            $conn = new database();
            if ($conn->getStatus()) {
                $status = "Pending";
                $stmt = $conn->getConnection()->prepare($this->addAssignmentQuery());
                $stmt->execute(
                    array(
                        $this->getId(),
                        $title,
                        $description,
                        $duedate,
                        $status,
                        $this->getCurrentDate(), $this->getCurrentDate()
                    )
                );
                $result = $stmt->fetch();
                if (!$result) {
                    return "addedAssignment";
                } else {
                    return "failedAssignment";
                }
            } else {
                return 'failedConnection';
            }
        } catch (PDOException $error) {
            return $error . "connectionErrors";
        }
    }
    // Get the Subject Notes Data and Display
    private function getAssignment()
    {
        try {
            $conn = new database();
            if ($conn->getStatus()) {
                $stmt = $conn->getConnection()->prepare($this->getAssignmentQuery());
                $stmt->execute(array($this->getId()));
                $result = $stmt->fetchAll();
                return json_encode($result);
            } else {
                return 'failedConnection';
            }
        } catch (PDOException $error) {
            return $error . ": Found Error";
        }
    }
    // Delete the Subject Notes Data
    private function deleteAssignment($boxId)
    {
        try {
            $conn = new database();
            if ($conn->getStatus()) {
                $stmt = $conn->getConnection()->prepare($this->deleteAssignmentQuery());
                $stmt->execute(array($boxId));
                return 'deletedSuccessfully';
            } else {
                return 'failedConnection';
            }
        } catch (PDOException $error) {
            return $error . ": Found Error";
        }
    }
    private function completeAssignment($boxId)
    {
        try {
            $conn = new database();
            if ($conn->getStatus()) {
                $status = "Completed";
                $stmt = $conn->getConnection()->prepare($this->updateAssignmentStatusQuery());
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
    private function getSearchDisplay($searchInp)
    {
        try {
            $conn = new database();
            if ($conn->getStatus()) {
                $stmt = $conn->getConnection()->prepare($this->getAssignmentInfoQuery());
                $stmt->execute(array($this->getId(), $searchInp));
                $result = $stmt->fetchAll();
                $tmp = null;
                if ($result) {
                    $tmp = $result;
                    return json_encode($tmp);
                } else {
                    return 'Not Found Data';
                }
            } else {
                return 'failedConnection';
            }

        } catch (PDOException $error) {
            return $error . ": Found Error";
        }
    }
    /* Assignment - Functionality - END */
    // Get the User ID
    private function getId()
    {
        try {
            $conn = new database();
            if ($conn->getStatus()) {
                $stmt = $conn->getConnection()->prepare($this->getNameQuery());
                $stmt->execute(array($_SESSION['email'], $_SESSION['password']));
                $tmp = null;
                while ($row = $stmt->fetch()) {
                    $tmp = $row['id'];
                }
                return $tmp;
            } else {
                return 'failedConnection';
            }
        } catch (PDOException $error) {
            return $error . ": Found Error";
        }
    }

    //Get Date
    private function getCurrentDate()
    {
        return date("F j, Y, g:i a");
    }
    //Get User Email and Password Query
    private function getNameQuery()
    {
        return "SELECT * FROM `tbl_user` WHERE `email` = ? AND `password` = ?";
    }
    /* ASSIGNMENT QUERY - START */
    private function addAssignmentQuery()
    {
        return "INSERT INTO `tbl_assignments` (`user_id`, `title`, `description`, 
        `due_date` ,`status` ,`created_date`, `updated_date`) 
        VALUES (?,?,?,?,?,?,?)";
    }
    private function getAssignmentQuery()
    {
        return "SELECT * FROM `tbl_assignments` WHERE `user_id` = ?";
    }
    private function updateAssignmentStatusQuery()
    {
        return "UPDATE `tbl_assignments` SET `status` = ?, `updated_date` = ? WHERE `id`=?";
    }
    private function getAssignmentInfoQuery()
    {
        return "SELECT * FROM `tbl_assignments` WHERE `user_id` = ? AND `title` = ?";
    }
    private function deleteAssignmentQuery()
    {
        return "DELETE FROM `tbl_assignments` WHERE `id` = ?";
    }
/* ASSIGNMENT QUERY - END */
}
?>