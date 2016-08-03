<?php
class UDataController extends Controller{
    function db(){
        /* 指定丟給哪個 models */
        $config = $this->model("config");
        return $config->getDB();
    }
    public function join_act(){
        $aId = $_GET['aId'];
        $num = $_GET['num'];
        $partner = $_GET['partner'];
       
        if($partner!=null){
            $row = "活動編號:".$aId." 員工編號:".$num." 攜伴人數:".$partner;
        }else{
            $row = "活動編號:".$aId." 員工編號:".$num;

        }
        /* 先確認 名額是否已滿 */
        
        /* 
            if(沒滿) -> 報名動作
            else -> 告知名額已滿
        */
        
        $this->view("showinformation",$row);
    }
}
?>