<?php 
session_start();
require('../server/assignment.php');
if(isset($_POST['choice'])){
    switch($_POST['choice']){            
        case 'addAssignment':
            $assignment = new assignment();
            echo $assignment->doAddAssignment($_POST['title'], $_POST['description'], $_POST['duedate']);
            break;

        case 'viewAssignment':
            $assignment = new assignment();
            echo $assignment->doViewAssignment();
            break;

        case 'deleteAssignment':
            $assignment = new assignment();
            echo $assignment->doDeleteAssignment($_POST['boxId']);
            break;
        
        case 'completeAssignment':
            $assignment = new assignment();
            echo $assignment->doCompleteAssignment($_POST['boxId']);
            break;            
        
        case 'getSearchDisplay':
            $assignment = new assignment();
            echo $assignment->doSetSearchDisplay($_POST['searchInp']);
            break;   
    }
}
?>