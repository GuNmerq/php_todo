<?php 
require_once('Model.php');
class TaskModel extends Model{
    private $pdo;
    public function __construct(){
        parent::__construct();
        $this->pdo = parent::getPDO();
    }

    public function get(){
        $stmt = $this->pdo->query("SELECT * FROM tasks");
        try {
            $data = $stmt->fetchAll();

        } catch (PDOException $e) {

            exit('取得失敗' . $e->getMessage());
        }
        $tasks = array();
        foreach($data as $task){
            if($task['user_id'] === $_SESSION['id']){
                array_push($tasks,$task);
            }
        }
        return $tasks;
    }

    public function add($content,$category_id,$user_id){
        $stmt = $this->pdo->prepare("INSERT INTO tasks (content,category_id,user_id) values(:content,:category_id,:user_id)");
        $stmt->bindValue(':content',$content,PDO::PARAM_STR);
        $stmt->bindValue(':category_id',$category_id,PDO::PARAM_INT);
        $stmt->bindValue(':user_id',$user_id,PDO::PARAM_INT);

        try {
            $stmt->execute();

        } catch (PDOException $e) {

            exit('登録失敗' . $e->getMessage());
        }
    }
    public function delete($id){
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->bindValue(':id',$id,PDO::PARAM_INT);
        try {
            $stmt->execute();

        } catch (PDOException $e) {

            exit('削除失敗' . $e->getMessage());
        }
    }

    public function update($id,$content,$category_id){
        $stmt = $this->pdo->prepare("UPDATE tasks SET content = :content, category_id = :category_id WHERE id = :id");
        $stmt->bindValue(':content',$content,PDO::PARAM_STR);
        $stmt->bindValue(':category_id',$category_id,PDO::PARAM_INT);
        $stmt->bindValue(':id',$id,PDO::PARAM_INT);

        try {
            $stmt->execute();

        } catch (PDOException $e) {

            exit('登録失敗' . $e->getMessage());
        }
    }

    public function switch($id){
        $stmt = $this->pdo->prepare("UPDATE tasks SET status = :status WHERE id = :id");
        if($_GET['s'] == 0){
            $switch = 1;
        }else{
            $switch = 0;
        }
        $stmt->bindValue(':status',$switch,PDO::PARAM_BOOL);
        $stmt->bindValue(':id',$id,PDO::PARAM_INT);

        try {
            $stmt->execute();

        } catch (PDOException $e) {

            exit('登録失敗' . $e->getMessage());
        }
    }
}
?>