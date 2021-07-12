<?php 
require_once('Model.php');
class TaskModel extends Model{
    private $pdo;
    public function __construct(){
        parent::__construct();
        $this->pdo = parent::getPDO();
    }

    public function get(){
        $data = $this->pdo->query("SELECT * FROM tasks");
        try {
            $posts = $data->fetchAll();

        } catch (PDOException $e) {

            exit('取得失敗' . $e->getMessage());
        }

        return $posts;
    }

    public function add($content,$category_id){
        $data = $this->pdo->prepare("INSERT INTO tasks (content,category_id) values(:content,:category_id)");
        $data->bindValue(':content',$content,PDO::PARAM_STR);
        $data->bindValue(':category_id',$category_id,PDO::PARAM_INT);

        try {
            $data->execute();

        } catch (PDOException $e) {

            exit('登録失敗' . $e->getMessage());
        }
    }
}
?>