<?php
//connect to the dbconfig.php
require_once 'dbconfig.php';

//kanu pang edit sa task
if(isset($_POST['btn-edit'])){  
    $task_id = $_POST['task_id'];
    $newtask = $_POST['newTask'];
    $user->editTask($task_id, $newtask);
    header('Location: Dashboard.php');
}
?>