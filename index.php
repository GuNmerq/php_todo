<?php
ini_set('display_errors', "On");
require_once('./route/reqUrl.php');
require_once('./controller/TaskController.php');
require_once('./controller/UserController.php');
require_once('./controller/CategoryController.php');

$getUrl = new getUrl();
$url = $getUrl->getPath();

switch ($url) {
    case '/':
    case '/task':
        $taskController = new TaskController();
        $taskController->indexAction();
        break;
    case '/task/add':
        $taskController = new TaskController();
        $taskController->addAction();
        break;
    case '/task/delete':
        $taskController = new TaskController();
        $taskController->deleteAction();
        break;
    case '/task/edit':
        $taskController = new TaskController();
        $taskController->editAction();
        break;
    case '/task/edit/cancel':
        $taskController = new TaskController();
        $taskController->editCancelAction();
        break;
    case '/task/update':
        $taskController = new TaskController();
        $taskController->updateAction();
        break;
    case '/task/switch':
        $taskController = new TaskController();
        $taskController->switchAction();
        break;
    case '/user/add':
        $userController = new UserController();
        $userController->addAction();
        break;
    case '/user/login':
        $userController = new UserController();
        $userController->loginAction();
        break;
    case '/user/logout':
        $userController = new UserController();
        $userController->logoutAction();
        break;
    case '/category':
        $categoryController = new CategoryController();
        $categoryController->indexAction();
        break;
    case '/category/add':
        $categoryController = new CategoryController();
        $categoryController->addAction();
        break;
    case '/category/delete':
        $categoryController = new CategoryController();
        $categoryController->deleteAction();
        break;
    default:
        break;
}
