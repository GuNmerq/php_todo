<?php 
require_once('Model.php');

class CategoryModel extends Model{

    private $pdo;
    public function __construct(){
        parent::__construct();

        $this->pdo = parent::getPDO();
    }

    public function get(){
        $stmt = $this->pdo->query("SELECT * FROM categories");
        try {
            $data = $stmt->fetchAll();

        } catch (PDOException $e) {

            exit('取得失敗' . $e->getMessage());
        }

        $categories = array();

        foreach($data as $category){
            if($category['user_id'] === $_SESSION['id']){
                array_push($categories,$category);
            }
        }
        return $categories;
    }

    public function add($content){
        $stmt = $this->pdo->prepare("INSERT INTO categories (content,user_id) values(:content,:user_id)");
        $stmt->bindValue(':content',$content,PDO::PARAM_STR);
        $stmt->bindValue(':user_id',$_SESSION['id'],PDO::PARAM_INT);

        try {
            $stmt->execute();

        } catch (PDOException $e) {

            exit('登録失敗' . $e->getMessage());
        }
    }
    public function delete($id){
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindValue(':id',$id,PDO::PARAM_INT);
        try {
            $stmt->execute();

        } catch (PDOException $e) {

            exit('削除失敗' . $e->getMessage());
        }
    }
}
?>