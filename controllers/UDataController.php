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
        if($partner == null){
            $partner = 0;
        }
        $join_total = $partner +1;
        
        /* 先確認 名額是否已滿 */
        $db = $this->db();
        $result = $this->model("crud");
        $row = $result->check_join_num($db,$aId);
        foreach($row as $key){
            $total_num = $key['num'];//可報名人數
            $join_num = $key['join_num'];//已報名人數
        }
        $surplus = $total_num -$join_num;//剩餘名額
       
        if($surplus == 0){
            $show_info = "人數已滿";
            $this->view("showinformation",$show_info);
        }else{
            $check_join = $surplus - $join_total;//剩餘名額-要報名的人數，確認可不可以報名
            if($check_join < 0){
                $show_info =  "超出可報名人數，不建議攜伴參加";
                $this->view("showinformation",$show_info);
            }else{
                /* update act.join_num */
                $row = $result->update_act_join_num($db,$aId,$join_total);
                /* 執行 insert */
                $row2 = $result->join_act($db,$num,$partner,$aId);
                $this->view("showinformation",$row2);
               
            }
        }
        
    }
}
?>