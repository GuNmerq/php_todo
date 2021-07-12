<?php 
ini_set('display_errors', "On");
require_once('./route/reqUrl.php');
require_once('./controller/TaskController.php');
require_once('./controller/UserController.php');

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
        break;
    case '/user/add':
        $userController = new UserController();
        $userController->add();
        break;
}


?>