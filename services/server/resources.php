<?php
require('../config/database.php');
class resources
{
    // Open Method
    public function doAddResources($title, $url)
    {
        return self::addResources($title, $url);
    }
    public function doDisplayResources()
    {
        return self::getResources();
    }
    public function doDeleteResources($boxId)
    {
        return self::deleteResources($boxId);
    }
    public function doSetSearchDisplay($searchInp)
    {
        return self::getSearchDisplay($searchInp);
    }
    /* Assignment - Functionality - START */
    // Add Assignment Data
    private function addResources($title, $url)
    {
        try {
            $conn = new database();
            if ($conn->getStatus()) {
                $stmt = $conn->getConnection()->prepare($this->addResourcesQuery());
                $stmt->execute(array($this->getId(),$title,$url,$this->getCurrentDate()));
                if ($stmt) {
                    return "addedResources";
                } else {
                    return "failedAssignments";
                }
            } else {
                return 'failedConnection';
            }
        } catch (PDOException $error) {
            return $error . "connectionErrors";
        }
    }
    // Get the Assignment Data and Display
    private function getResources()
    {
        try {
            $conn = new database();
            if ($conn->getStatus()) {
                $stmt = $conn->getConnection()->prepare($this->getResourcesQuery());
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
    // Delete the Assignment Data
    private function deleteResources($boxId)
    {
        try {
            $conn = new database();
            if ($conn->getStatus()) {
                $stmt = $conn->getConnection()->prepare($this->deleteResourcesQuery());
                $stmt->execute(array($boxId));
                return 'deletedSuccessfully';
            } else {
                return 'failedConnection';
            }
        } catch (PDOException $error) {
            return $error . ": Found Error";
        }
    }
    // Search Display for Assignment Data
    private function getSearchDisplay($searchInp)
    {
        try {
            $conn = new database();
            if ($conn->getStatus()) {
                $stmt = $conn->getConnection()->prepare($this->getResourcestInfoQuery());
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
    private function addResourcesQuery()
    {
        return "INSERT INTO `tbl_resources` (`user_id`, `title`, `url_link` ,`created_date`) 
        VALUES (?,?,?,?)";
    }
    private function getResourcesQuery()
    {
        return "SELECT * FROM `tbl_resources` WHERE `user_id` = ?";
    }
    private function getResourcestInfoQuery()
    {
        return "SELECT * FROM `tbl_resources` WHERE `user_id` = ? AND `title` = ?";
    }
    private function deleteResourcesQuery()
    {
        return "DELETE FROM `tbl_resources` WHERE `id` = ?";
    }
/* ASSIGNMENT QUERY - END */
}
?>