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
    }
}
?>