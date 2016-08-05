<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
class act
{

   /* 活動列表 */
   public function act_list($db){
       $result = $db->prepare("SELECT * FROM `act`");
       $result->execute(array());
       return $result;
   }
   /* 建立活動 */
   public function create_act($db,$uId,$name,$body,$num,$partner,$date_s,$time_s,$date_f,$time_f){
      $result = $db->prepare("INSERT INTO `act`(`name`, `num`, `partner`, `date_s`, `time_s`, `date_f`, `time_f`, `uId`, `body`) VALUES (?,?,?,?,?,?,?,?,?)");
      $result->execute(array($name,$num,$partner,$date_s,$time_s,$date_f,$time_f,$uId,$body));//依序取代sql中"?"的值，並執行
      return true;
   }
   /* show點選的資料 */
   public function show_act($db,$aId){
      $result = $db->prepare("SELECT * FROM `act` WHERE `aId` = ?");
      $result->execute(array($aId));//依序取代sql中"?"的值，並執行
      $row = $result->fetchAll();
      return $row;
   }
   /* 修改活動-2 */
   public function update_act($db,$aId,$name,$body,$num,$partner,$date_s,$time_s,$date_f,$time_f){
      $result = $db->prepare("UPDATE `act` SET `name` = ?,`num` = ? ,`partner` = ? ,`date_s` = ? ,`time_s` = ?,`date_f` = ? ,`time_f` = ? ,`body` = ? WHERE `aId` = ?");
      $result->execute(array($name,$num,$partner,$date_s,$time_s,$date_f,$time_f,$body,$aId));//依序取代sql中"?"的值，並執行
      return true;
   }
   /* 刪除活動 */
   public function delete_act($db,$aId){
      $result = $db->prepare("DELETE FROM `act` WHERE `aId` = ?");
      $result->execute(array($aId));//依序取代sql中"?"的值，並執行
      return true;
   }
   /* 確認名額 */
   public function check_join_num($db,$aId){
      $result = $db->prepare("SELECT `num`,`join_num` FROM `act` WHERE `aId` = ? FOR UPDATE");
      $result->execute(array($aId));//依序取代sql中"?"的值，並執行
      $row = $result->fetchAll();
      return $row;
   }
   /* 更新參加人數 */
   public function update_act_join_num($db,$aId,$join_total){
      $result2 = $db->prepare("UPDATE `act` SET `join_num`=`join_num`+? WHERE `aId` = ?");
      $result2->execute(array($join_total,$aId));
      return true;
   }
  
}
?>
