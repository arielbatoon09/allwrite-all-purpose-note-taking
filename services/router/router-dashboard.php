<?php 
session_start();
require('../server/dashboard.php');
if(isset($_POST['choice'])){
    switch($_POST['choice']){
        case 'profileName':
            $dashboard = new dashboard();
            echo $dashboard->doViewName();
            break;
            
        case 'addSubNotes':
            $dashboard = new dashboard();
            echo $dashboard->doAddSubNotes($_POST['title'], $_POST['description']);
            break;

        case 'viewSubNotes':
            $dashboard = new dashboard();
            echo $dashboard->doViewSubNotes();
            break;

        case 'logout':
            session_destroy();
            break;
    }
}
?>