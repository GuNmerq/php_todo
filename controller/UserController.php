<?php 
require_once('Controller.php');
require_once('./model/UserModel.php');

class UserController extends Controller {
    public function __construct(){
        //parent::__construct();
    }
    public function addAction(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
    }
}
?>