<?php 
session_start();
require('../server/authentication.php');
if(isset($_POST['choice'])){
    switch($_POST['choice']){
        case 'register':
            $authentication = new authentication();
            echo $authentication->doRegister($_POST['fullname'], $_POST['email'], $_POST['password'],
            $_POST['confirmpass']);
            break;

        case 'login':
            $authentication = new authentication();
            echo $authentication->doLogin($_POST['email'], $_POST['password']);
            break;
        case 'logout':
            session_destroy();
            break;
    }
}
?>