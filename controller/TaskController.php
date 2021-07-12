<?php 
    require_once('Controller.php');
    require_once('./model/TaskModel.php');
    require_once('./model/CategoryModel.php');

    class TaskController extends Controller{
        public function __construct(){
            //parent::__construct();
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

            $taskModel = new TaskModel();
            $taskModel->add($content,$category_id);

            $errors = $this->addValidation($content);

            if (count($errors) === 0) {
                
                $taskModel = new TaskModel();
                $taskModel->add($content, $category_id);
                header('Location: /php_todo/task');
                exit();
            }
        }


        private function addValidation($content){

        $errors = [];
        if (empty($content)){
            $errors['content'] = '本文がありません。<br>';
        }
        return $errors;
    }
    }
?>