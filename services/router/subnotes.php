<?php 
session_start();
require('../server/subject.php');
if(isset($_POST['choice'])){
    switch($_POST['choice']){            
        case 'addSubNotes':
            $subnotes = new subject();
            echo $subnotes->doAddSubNotes($_POST['title'], $_POST['description']);
            break;

        case 'viewSubNotes':
            $subnotes = new subject();
            echo $subnotes->doViewSubNotes();
            break;

        case 'displaySubNotes':
            $subnotes = new subject();
            echo $subnotes->doDisplaySubNotes();
            break;
        
        case 'deleteSubNotes':
            $subnotes = new subject();
            echo $subnotes->doDeleteSubNotes($_POST['boxId']);
            break;

        case 'setSessionBoxId':
            $subnotes = new subject();
            echo $subnotes->doSetSessionBoxId($_POST['boxId']);
            break;
        
        case 'getSearchDisplay':
            $subnotes = new subject();
            echo $subnotes->doSetSearchDisplay($_POST['searchInp']);
            break;    

        case 'updateSubNotes':
            $subnotes = new subject();
            echo $subnotes->doUpdateSubNotes($_POST['title'], $_POST['description']);
            break;

        case 'unsetSessionBoxId':
            unset($_SESSION["setBoxId"]);
            break;
    }
}
?>