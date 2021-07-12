<?php 
ini_set('display_errors', "On");
require_once('./route/reqUrl.php');
require_once('./controller/TaskController.php');

$getUrl = new getUrl();
$url = $getUrl->getPath();

switch($url){
    case '/':
    case '/task':
        $taskController = new TaskController();
        $taskController->indexAction();
        break;
    case '/task/add':
        $taskController = new TaskController();
        $taskController->addAction();
        array_push($testCount,'A');
        break;
}


?>