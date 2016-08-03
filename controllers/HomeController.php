<?php
session_start();

class HomeController extends Controller {
    function db(){
        /* 指定丟給哪個 models */
        $config = $this->model("config");
        return $config->getDB();
    } 
    /* 跳轉到 主頁面(index.php) 頁面 */
    function index() {
         /* 指定丟給哪個 models */
        $result = $this->model("crud");
        $db = $this->db();
        /* 要執行哪個 function 並且給值 */
        $row = $result->act_list($db);
        $this->view("user/index",$row);
       
    }
    function show_act() {
        $aId = $_GET['aId'];
        // echo $aId;
         /* 指定丟給哪個 models */
        $result = $this->model("crud");
        $db = $this->db();
        /* 要執行哪個 function 並且給值 */
        $row = $result->show_act($db,$aId);
        $this->view("user/show_act",$row);
       
    }
    
}
?>