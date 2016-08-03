<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
class MDataController extends Controller{
    function db(){
        /* 指定丟給哪個 models */
        $config = $this->model("config");
        return $config->getDB();
   }
   /* 管理者登入 */
   function login(){
       $account = $_GET['account'];
       $password = $_GET['password'];
       $result = $this->model("crud");
       $db = $this->db();
       $row = $result->login($db,$account,$password);
       $this->view("showinformation",$row);
   }
   /* 管理者登出 */
   function logout(){
       unset($_SESSION['uId']);
       header("Location:../MHome");
   }
   /* 建立活動 */
    function create_act(){
        $uId = $_SESSION['uId'];
        $name = $_GET['name'];
        $body = $_GET['body'];
        $num = $_GET['num'];
        $partner = $_GET['partner'];
        $date_s = $_GET['date_s'];
        $time_s = $_GET['time_s'];
        $date_f = $_GET['date_f'];
        $time_f = $_GET['time_f'];
        /* 指定丟給哪個 models */
        $result = $this->model("crud");
        $db = $this->db();
        /* 要執行哪個 function 並且給值 */
        $row = $result->create_act($db,$uId,$name,$body,$num,$partner,$date_s,$time_s,$date_f,$time_f);
        
        header("Location:../MHome");
       
    }
    /* 更新活動 */
    function update_act(){
        $aId = $_GET['aId'];
        $name = $_GET['name'];
        $body = $_GET['body'];
        $num = $_GET['num'];
        $partner = $_GET['partner'];
        $date_s = $_GET['date_s'];
        $time_s = $_GET['time_s'];
        $date_f = $_GET['date_f'];
        $time_f = $_GET['time_f'];
       
     
        /* 指定丟給哪個 models */
        $result = $this->model("crud");
        $db = $this->db();
        /* 要執行哪個 function 並且給值 */
        $row = $result->update_act($db,$aId,$name,$body,$num,$partner,$date_s,$time_s,$date_f,$time_f);
        header("Location:../MHome");
        
    }
    function delete_act(){
        $aId = $_GET['aId'];
       
        /* 指定丟給哪個 models */
        $result = $this->model("crud");
        $db = $this->db();
        // /* 要執行哪個 function 並且給值 */
        $row = $result->delete_act($db,$aId);
        
        header("Location:../MHome");
    }
    //  function create_people_act(){
    //     $aId = $_GET['aId'];
    //     $num = $_POST['num'];
    //     $name = $_POST['name'];
       
    //     /* 指定丟給哪個 models */
    //     $result = $this->model("crud");
    //     $db = $this->db();
    //     // /* 要執行哪個 function 並且給值 */
    //     $row = $result->create_people_act($db,$aId,$num,$name);
        
    //     header("Location:../Home/create_people_act");
    // }
}
?>