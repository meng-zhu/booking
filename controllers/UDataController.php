<?php
class UDataController extends Controller{
    function db(){
        /* 指定丟給哪個 models */
        $config = $this->model("config");
        return $config->getDB();
    }
    public function join_act(){
        $aId = $_GET['aId'];
        $eId = $_GET['eId'];
        $partner = $_GET['partner'];
        if($partner == null){
            $partner = 0;
        }
        $join_total = $partner +1;
        
        /* 先確認 名額是否已滿 */ 
        
        
        try{
            $db = $this->db();
            $can_join = $this->model("can_join");
            
            // sleep(5);
            $db->beginTransaction();
            
            $check_can_join = $can_join->check_can_join($db,$eId,$aId);//確認可不可以報名
            
            if($check_can_join){
                $act = $this->model("act");
                $row = $act->check_join_num($db,$aId);//確認名額是否已滿
                foreach($row as $key){ 
                    $total_num = $key['num'];//可報名人數
                    $join_num = $key['join_num'];//已報名人數
                }
                $surplus = $total_num -$join_num;//剩餘名額
               
                if($surplus == 0){
                    $show_info = "人數已滿";
                    throw new Exception($show_info);
                }else{
                    $check_join = $surplus - $join_total;//剩餘名額-要報名的人數，確認可不可以報名
                    if($check_join < 0){
                        $show_info =  "超出可報名人數，不建議攜伴參加";
                        throw new Exception($show_info);
                    }else{
                        $join_act = $this->model("join_act");
                        $check_row = $join_act->check_join($db,$eId,$aId);//確認是否已經在報名名單內
                        if($check_row){
                           
                            /* 執行 insert */
                            $join_act = $this->model("join_act");
                            $row2 = $join_act->join_act_insert($db,$eId,$partner,$aId);
                            if($row2){
                                /* update act.join_num */
                                $row = $act->update_act_join_num($db,$aId,$join_total);
                                if($row){
                                     $show_info = "報名完成";
                                }
                               
                            }
                        }else{
                            $show_info = "已在名單內，不得重複報名";
                            throw new Exception($show_info);
                        }
                        
                       
                    }
                }
            }else{
                $show_info =  "你不能報名此活動";
                throw new Exception($show_info);
            }
            
            $db->commit();
        	$db = NULL;
        	
        }catch(Exception $show_info){
            $db->rollback();
            $this->view("showinformation",$show_info->getMessage());
        	exit();     
        }
         $this->view("showinformation",$show_info);
        
    }
}
?>