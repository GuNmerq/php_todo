<?php
require_once('Controller.php');
require_once('./model/CategoryModel.php');
require_once('controller/Validation.php');
class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->get();
        require('public/view/CategoryIndex.php');
    }

    public function addAction(){
        $content = $_POST['content'];

        $errors = $this->addValidation($content);

        if(empty($errors)){
            $categoryModel = new CategoryModel();
            $categoryModel->add($content);
        }
        header('Location: /php_todo/category');
        exit();

    }
    public function deleteAction(){
        $id = $_POST['param'];

        $categoryModel = new CategoryModel();
        $categoryModel->delete($id);
        header('Location: /php_todo/category');
        exit();
    }
    private function addValidation($content){

        $errors = [];

        if (empty($content)){
            $errors['name'] = 'カテゴリ名がありません。<br>';
        }
        if (mb_strlen($content) > 80){
            $errors['name'] = 'カテゴリ名が長すぎます。<br>';
        }
        return $errors;
    }
}
?>