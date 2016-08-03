<?php

class Controller {
    
    public function model($model) {
        require_once "../booking/models/$model.php";
        return new $model ();
    }
    
    public function view($view, $data = Array(),$data2=Array()) {
        require_once "../booking/views/$view.php";
    }
}

?>