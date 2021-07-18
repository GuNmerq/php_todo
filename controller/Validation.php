<?php 
class Validation {
    public function blankCheck($value){
        return empty($value);
    }

    public function emailCheck($value){
        if(filter_var($value,FILTER_VALIDATE_EMAIL)){
            return false;
        }else{
            return true;
        }
    }

    function length4_10Check($value)
    {
        if(($value < 4) or ($value > 10)) {
            return true;
        } else {
            return false;
        }
    }

    function length50Check($value)
    {
        if($value > 50) {
            return true;
        } else {
            return false;
        }
    }

    function typeCheck($value)
    {
        if (!preg_match("/^[A-Za-z0-9_]+$/",$value)) {
            return true;
        } else {
            return false;
        }
    }

}
?>