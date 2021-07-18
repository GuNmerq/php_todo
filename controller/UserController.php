<?php
require_once('Controller.php');
require_once('Validation.php');
require_once('./model/UserModel.php');

class UserController extends Controller
{
    public function __construct(){
    }

    public function addAction()
    {
        if (isset($_POST['signup'])) {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            $errors = $this->validateAdd($_POST);

            if (count($errors) === 0) {
                $userModel = new UserModel();
                $userModel->addUser($name, $email, $pass);
                $user = $userModel->getUser($email, $pass);
                $_SESSION['username'] = $user[0]['name'];
                $_SESSION['id'] = $user[0]['id'];
                header('Location: /php_todo/task');
                exit;
            } else {
                require('public/view/UserAdd.php');
                exit;
            }
        }

        require('public/view/UserAdd.php');
    }
    public function loginAction()
    {
        if (isset($_POST['signin'])) {

            $email = $_POST['email'];
            $pass = $_POST['pass'];

            $errors = $this->validateLogin($_POST);

            if (count($errors) === 0) {
                $userModel = new UserModel();
                $user = $userModel->getUser($email, $pass);
                if ($user > 0) {
                    $_SESSION['name'] = $user[0]['name'];
                    $_SESSION['id'] = $user[0]['id'];
                    header('Location: /php_todo/task');
                    exit;
                }
            } else {
                require('public/view/UserLogin.php');
                exit;
            }
        }

        require('public/view/UserLogin.php');
    }
    public function logoutAction(){
        $_SESSION['id'] = null;
        $_SESSION['name'] = null;
        header('Location: /php_todo/task');
    }
    public function validateAdd($input)
    {
        $errors = [];
        $validation = new Validation();

        foreach ($_POST as $key => $value) {
            if ($validation->blankCheck($input[$key])) {
                switch ($key) {
                    case 'email':
                        $errors[$key] = 'メールアドレスを入力してください';
                        break;
                    case 'pass':
                        $errors[$key] = 'パスワードを入力してください';
                        break;
                    case 'name':
                        $errors[$key] = 'ユーザ名を入力してください';
                        break;
                    default:
                        break;
                }
            }
        }
        $userModel = new UserModel();
        if ($userModel->countEmail($_POST['email']) > 0) {
            $errors['email'] = 'そのメールアドレスは既に使用されています。<br>別のメールアドレスを使用してください。';
        }
        if ($validation->emailCheck($_POST['email'])) {
            $errors['email'] = 'メールアドレスの形式が正しくありません。正しく入力してください。';
        }
        if ($validation->typeCheck($_POST['pass'])) {
            $errors['pass'] = 'パスワードは半角英数字で入力してください';
        }
        if ($validation->length4_10Check(mb_strlen($_POST['name'], 'UTF-8'))) {
            $errors['username'] = 'ユーザー名は4〜10文字で入力してください。';
        }
        if ($validation->length50Check(strlen($_POST['email']))) {
            $errors['email'] = 'メールアドレスは50文字以内で入力してください。';
        }
        if ($validation->length4_10Check(strlen($_POST['pass']))) {
            $errors['pass'] = 'パスワードは4〜10文字で入力してください。';
        }
        return $errors;
    }

    public function validateLogin($input)
    {
        $errors = [];
        $validation = new Validation();

        foreach ($_POST as $key => $value) {
            if ($validation->blankCheck($input[$key])) {
                switch ($key) {
                    case 'email':
                        $errors[$key] = 'メールアドレスを入力してください';
                        break;
                    case 'pass':
                        $errors[$key] = 'パスワードを入力してください';
                        break;
                    default:
                        break;
                }
            }
        }
        $userModel = new UserModel();
        if ($validation->emailCheck($_POST['email'])) {
            $errors['email'] = 'メールアドレスの形式が正しくありません。正しく入力してください。';
        }
        if ($validation->typeCheck($_POST['pass'])) {
            $errors['pass'] = 'パスワードは半角英数字で入力してください';
        }
        if ($validation->length50Check(strlen($_POST['email']))) {
            $errors['email'] = 'メールアドレスは50文字以内で入力してください。';
        }
        if ($validation->length4_10Check(strlen($_POST['pass']))) {
            $errors['pass'] = 'パスワードは4〜10文字で入力してください。';
        }
        return $errors;
    }
}
