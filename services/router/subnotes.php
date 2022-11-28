<?php 
session_start();
require('../server/subject.php');
if(isset($_POST['choice'])){
    switch($_POST['choice']){            
        case 'addSubNotes':
            $dashboard = new subject();
            echo $dashboard->doAddSubNotes($_POST['title'], $_POST['description']);
            break;

        case 'viewSubNotes':
            $dashboard = new subject();
            echo $dashboard->doViewSubNotes();
            break;

        case 'displaySubNotes':
            $dashboard = new subject();
            echo $dashboard->doDisplaySubNotes();
            break;
        
        case 'deleteSubNotes':
            $dashboard = new subject();
            echo $dashboard->doDeleteSubNotes($_POST['boxId']);
            break;

        case 'setSessionBoxId':
            $dashboard = new subject();
            echo $dashboard->doSetSessionBoxId($_POST['boxId']);
            break;
        
        case 'getSearchDisplay':
            $dashboard = new subject();
            echo $dashboard->doSetSearchDisplay($_POST['searchInp']);
            break;    

        case 'updateSubNotes':
            $dashboard = new subject();
            echo $dashboard->doUpdateSubNotes($_POST['title'], $_POST['description']);
            break;

        case 'unsetSessionBoxId':
            unset($_SESSION["setBoxId"]);
            break;
    }
}
?>