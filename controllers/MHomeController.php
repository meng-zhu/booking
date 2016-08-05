<?php
session_start();

class MHomeController extends Controller {
    function db(){
        /* 指定丟給哪個 models */
        $config = $this->model("config");
        return $config->getDB();
    }
    /* 跳轉 登入(login)頁面 */
    function login(){
         $this->view("management/login");
    }
    /* 跳轉到 建立活動_活動列表(create_atc_list)頁面 */
    function index() {
        
        /* 指定丟給哪個 models */
        $result = $this->model("act");
        $db = $this->db();
        /* 要執行哪個 function 並且給值 */
        $row = $result->act_list($db);
        
        $this->view("management/index",$row);

    }
    /* 跳轉到 建立新活動(create_atc)頁面 */
    function create_act() {
        $this->view("management/create_act");
    }
     /* 跳轉到 編輯活動(update_atc)頁面 */
    function update_act() {
        $aId = $_GET['aId'];
        /* 指定丟給哪個 models */
        $result = $this->model("act");
        $db = $this->db();
        /* 要執行哪個 function 並且給值 */
        $row = $result->show_act($db,$aId);
        $this->view("management/update_act",$row);
    }
    function can_join(){
        $aId = $_GET['aId'];
        /* 指定丟給哪個 models */
        $result = $this->model("act");
        $db = $this->db();
        /* 要執行哪個 function 並且給值 */
        $row = $result->show_act($db,$aId);
        foreach($row as $key){
            $name = $key['name'];
        }
        
        $this->view("management/can_join",$aId,$name);
    }
    
}
?>