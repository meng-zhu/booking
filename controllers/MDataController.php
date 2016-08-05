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
       
      $result = $this->model("user");
      $db = $this->db();
      $row = $result->login($db,$account,$password);
      if($row){
          $show_info = "登入成功";
      }else{
          $show_info = "帳號或密碼輸入錯誤";
      }
      $this->view("showinformation",$show_info);
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
        $result = $this->model("act");
        $db = $this->db();
        /* 要執行哪個 function 並且給值 */
        $row = $result->create_act($db,$uId,$name,$body,$num,$partner,$date_s,$time_s,$date_f,$time_f);
        if($row){
            header("Location:../MHome");
        }
       
       
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
        $result = $this->model("act");
        $db = $this->db();
        /* 要執行哪個 function 並且給值 */
        $row = $result->update_act($db,$aId,$name,$body,$num,$partner,$date_s,$time_s,$date_f,$time_f);
        if($row){
             header("Location:../MHome");
        }
       
        
    }
    function delete_act(){
        $aId = $_GET['aId'];
       
        /* 指定丟給哪個 models */
        $result = $this->model("act");
        $db = $this->db();
        // /* 要執行哪個 function 並且給值 */
        $row = $result->delete_act($db,$aId);
        if($row){
            header("Location:../MHome");
        }
        
        
    }
    function show_join(){
        $aId = $_GET['aId'];
        
        /* 指定丟給哪個 models */
        $act = $this->model("act");
        $db = $this->db();
        /* 要執行哪個 function 並且給值 */
        $row_act = $act->show_act($db,$aId);
        $this->view("management/show_join",$row_act);
    }
    function show_join_people(){
        $aId = $_GET['aId'];
        $join_act = $this->model("join_act");
        $db = $this->db();
        $row_join = $join_act->show_join($db,$aId);
        $this->view("drawTable_show_join",$row_join);
       
    }
    function show_join_imm(){
        $aId = $_GET['aId'];
        
        /* 指定丟給哪個 models */
        $act = $this->model("act");
        $join_act = $this->model("join_act");
        $db = $this->db();
        /* 要執行哪個 function 並且給值 */
        $row_act = $act->show_act($db,$aId);
        foreach($row_act as $key){
           $join_num = $key['join_num'];
           $num = $key['num'];
        }
        $show_info =$join_num."/".$num;
        echo $show_info;
        // $row_join = $join_act->show_join($db,$aId);
        // $this->view("showinformation",$show_info);
    }
    function can_join(){
        $aId = $_GET['aId'];
        $type = $_GET['type'];
        $employee = $_GET['employee'];
        $show_info ="";
        if($type == "員工名稱"){
            $type = "name";
        }else{
            $type = "eId";
        }
        // echo "aID:".$aId." type:".$type." employee:".$employee;
        
         /* 指定丟給哪個 models */
        $employee_mo = $this->model("employee");
        $db = $this->db();
        /* 先確認有沒有該員工 */
        $row = $employee_mo->check_employee($db,$type,$employee);
        $count_row = count($row);
        if($count_row==1){
            foreach($row as $key){
                $eId =  $key['eId'];
                $name = $key['name'];
            }
            // $show_info  =$eId."and ".$name;
            // $show_info  = $name;
            $can_join = $this->model("can_join");
            // $db = $this->db();
            /* 確認有該名員工，將他+進可報名名單*/
            $row2 = $can_join->show_can_join($db,$eId,$name,$aId);
            if($row2){
                $show_info = "新增成功";
            }else{
                $show_info = "此人已在名單中";
            }
        }else{
          $show_info = "查無此人";
        } 
        $this->view("showinformation",$show_info);
    }
   
}
?>