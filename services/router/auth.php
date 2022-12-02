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

        case 'changepassword':
            $authentication = new authentication();
            echo $authentication->doChangePassword($_POST['oldpassword'], 
            $_POST['newpassword'], $_POST['confirmpassword']);
            break;   

        case 'setpincode':
            $authentication = new authentication();
            echo $authentication->doSetPinCode($_POST['pincode'], $_POST['confirmpincode']);
            break;      
            
        case 'retrievePass':
            $authentication = new authentication();
            echo $authentication->doRetrievePassword($_POST['email'], $_POST['pincode'], $_POST['newpassword']);
            break;   
    }
}
?>