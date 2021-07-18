<?php 
    require_once('Controller.php');
    require_once('./model/TaskModel.php');
    require_once('./model/CategoryModel.php');

    class TaskController extends Controller{
        public function __construct(){
            parent::__construct();
        }

        public function indexAction(){
            $taskModel = new TaskModel();
            $tasks = $taskModel->get();
            $categoryModel = new CategoryModel();
            $categories = $categoryModel->get();
            require('./public/view/TaskIndex.php');
        }

        public function addAction(){
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            $user_id = $_SESSION['id'];

            $errors = $this->addValidation($content);

            if (empty($errors)) {
                
                $taskModel = new TaskModel();
                $taskModel->add($content, $category_id,$user_id);
            }
            header('Location: /php_todo/task');
            exit();
        }
        public function deleteAction(){
            $id = $_POST['param'];

            $taskModel = new TaskModel();
            $taskModel->delete($id);

            header('Location: /php_todo/task');
            exit();
        }
        public function editAction(){
            $_SESSION['editId'] = $_POST['param'];

            header('Location: /php_todo/task');
        }

        public function editCancelAction(){
            $_SESSION['editId'] = null;
            header('Location: /php_todo/task');
        }

        public function updateAction(){
            $id = $_POST['param'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];

            $errors = $this->addValidation($content);

            if (empty($errors)) {
                
                $taskModel = new TaskModel();
                $taskModel->update($id,$content, $category_id);
            }
            header('Location: /php_todo/task');
            $_SESSION['editId'] = null;
            exit();
        }

        public function switchAction(){
                $taskModel = new TaskModel();
                $taskModel->switch($_GET['id']);
                header('Location: /php_todo/task');
        }


        private function addValidation($content){

        if (empty($content)){
            $errors = 'emptydata';
        }else{
            $errors = null;
        }
        return $errors;
    }
    }
?>