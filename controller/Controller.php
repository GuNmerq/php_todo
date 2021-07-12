<?php
session_start();
abstract class Controller
{
    function __construct(){
        if(empty($_SESSION['user'])) {
            header("Location: /PHP_TODO/login");
            exit;
        }
    }
}