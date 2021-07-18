<?php 
require_once('Model.php');
class UserModel extends Model {
    private $pdo;
    public function __construct(){
        parent::__construct();

        $this->pdo = parent::getPDO();
    }
    public function addUser($name,$email,$pass){
        $stmt = $this->pdo->prepare("INSERT INTO users (name,email,password) values(:name,:email,:pass)");
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $hashed_pass = password_hash($pass,PASSWORD_DEFAULT);
        $stmt->bindParam('pass',$hashed_pass,PDO::PARAM_STR);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            exit('登録失敗' . $e->getMessage());
        }
    }

    public function getUser($email,$pass){
        $stmt = $this->pdo->prepare('SELECT id, name, email, password
                FROM users
                WHERE  email= :email');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        try {
            $stmt->execute();
             $user = $stmt->fetchAll();
 
         } catch (PDOException $e) {
 
             exit('登録失敗' . $e->getMessage());
         }
         
         if (password_verify($pass, $user[0]['password'])) {
             return $user;
         }else{
             return [];
         }
    }

    public function countEmail($value){
        $stmt = $this->pdo->prepare("SELECT count(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email',$value,PDO::PARAM_STR);
        try {
            $stmt->execute();
            $count = $stmt->fetchColumn();
        } catch (PDOException $e) {

            exit('取得失敗' . $e->getMessage());
        }
                return $count;
    }
}
