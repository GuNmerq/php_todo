<?php
if (!isset($_SESSION)) {
    session_start();
}
abstract class Controller
{
    public function __construct()
    {
        if (empty($_SESSION['id'])) {
            header("Location: /PHP_TODO/user/login");
            exit;
        }
    }
}
