<?php 
session_start();
require('../server/resources.php');
if(isset($_POST['choice'])){
    switch($_POST['choice']){            
        case 'addResources':
            $resources = new resources();
            echo $resources->doAddResources($_POST['title'], $_POST['url']);
            break;

        case 'displayResources':
            $resources = new resources();
            echo $resources->doDisplayResources();
            break;
        
        case 'deleteResources':
            $resources = new resources();
            echo $resources->doDeleteResources($_POST['boxId']);
            break;
        
        case 'getSearchDisplay':
            $resources = new resources();
            echo $resources->doSetSearchDisplay($_POST['searchInp']);
            break;    

    }
}
?>