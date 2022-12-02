<?php 
session_start();
require('../server/todo.php');
if(isset($_POST['choice'])){
    switch($_POST['choice']){            
        case 'addToDo':
            $todolist = new todo();
            echo $todolist->doAddToDo($_POST['title'], $_POST['description']);
            break;

        case 'viewToDo':
            $todolist = new todo();
            echo $todolist->doViewToDo();
            break;
        
        case 'deleteToDo':
            $todolist = new todo();
            echo $todolist->doDeleteToDo($_POST['boxId']);
            break;

        case 'completeToDo':
            $todolist = new todo();
            echo $todolist->doCompleteToDo($_POST['boxId']);
            break; 
        
        case 'getSearchDisplay':
            $todolist = new todo();
            echo $todolist->doSetSearchDisplay($_POST['searchInp']);
            break;    
    }
}
?>