<?php 
    require_once('conf/DataBase.php');
    class Model{
        private $pdo;

        public function __construct(){
            try{
                $this->pdo = new PDO(
                    sprintf('mysql:host=%s;dbname=%s;charset=utf8',DataBase::HOST_NAME,DataBase::DB_NAME),
                    DataBase::DB_USER,
                    DataBase::DB_PASSWORD,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            }catch (PDOException $e) {

                exit('データベース接続失敗。' . $e->getMessage());
            }
        }
        public function getPDO(){
            return $this->pdo;
        }
    }
?>