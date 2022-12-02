<?php 
session_start();
require('../server/dashboard.php');
if(isset($_POST['choice'])){
    switch($_POST['choice']){
        case 'profileName':
            $dashboard = new dashboard();
            echo $dashboard->doViewName();
            break;

        case 'logout':
            session_destroy();
            break;

        case 'subnotesCount':
            $dashboard = new dashboard();
            echo $dashboard->doSubNotesCount();
            break;

        case 'assignmentCount':
            $dashboard = new dashboard();
            echo $dashboard->doAssignmentCount();
            break;        

        case 'resourcesCount':
            $dashboard = new dashboard();
            echo $dashboard->doResourcesCount();
            break;    
            
        case 'todoCount':
            $dashboard = new dashboard();
            echo $dashboard->doToDoCount();
            break;              
    }
}
?>