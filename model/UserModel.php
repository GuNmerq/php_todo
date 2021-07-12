<?php 
require_once('Model.php');
class UserModel extends Model {
    private $pdo;
    public function __construct(){
        parent::__construct();

        $this->pdo = parent::getPDO();
    }
    
}
?>