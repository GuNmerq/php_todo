<?php 
require_once('Model.php');

class CategoryModel extends Model{

    private $pdo;
    public function __construct(){
        parent::__construct();

        $this->pdo = parent::getPDO();
    }

    public function get(){
        $data = $this->pdo->query("SELECT * FROM categories");
        try {
            $categories = $data->fetchAll();

        } catch (PDOException $e) {

            exit('取得失敗' . $e->getMessage());
        }

        return $categories;
    }
}
?>