<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
class crud
{
/**************************************************管理者操作************************************************************************************/
   public function login($db,$account,$password){
      $result = $db->prepare("SELECT * FROM `user` WHERE `account` = ? AND `password` = ?");
      $result->execute(array($account, $password));//依序取代sql中"?"的值，並執行
      $row = $result->fetchAll();
      if(count($row)<1){
         return "帳號或密碼輸入錯誤";
      }else{
         foreach($row as $key){
            $_SESSION['uId'] = $key['uId'];
            return "成功登入";
         }
      }
   }
   /* 活動列表 */
   public function act_list($db){
       $result = $db->query("SELECT * FROM `act`");
       return $result;
   }
   /* 建立活動 */
   public function create_act($db,$uId,$name,$body,$num,$partner,$date_s,$time_s,$date_f,$time_f){
      $result = $db->prepare("INSERT INTO `act`(`name`, `num`, `partner`, `date_s`, `time_s`, `date_f`, `time_f`, `uId`, `body`) VALUES (?,?,?,?,?,?,?,?,?)");
      $result->execute(array($name,$num,$partner,$date_s,$time_s,$date_f,$time_f,$uId,$body));//依序取代sql中"?"的值，並執行
      return "活動建立完成";
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
      return "活動更新完成";
   }
   /* 刪除活動 */
   public function delete_act($db,$aId){
      $result = $db->prepare("DELETE FROM `act` WHERE `aId` = ?");
      $result->execute(array($aId));//依序取代sql中"?"的值，並執行
      return "活動刪除完成";
   }
/**************************************************一般使用者************************************************************************************/
   public function check_join_num($db,$aId){
      $result = $db->prepare("SELECT `num`,`join_num` FROM `act` WHERE `aId` = ?");
      $result->execute(array($aId));//依序取代sql中"?"的值，並執行
      $row = $result->fetchAll();
      return $row;
   }
   public function join_act($db,$num,$partner,$aId){
      $result = $db->prepare("INSERT INTO `join`( `num`, `partner`, `aId`) VALUES (?,?,?)");
      $result->execute(array($num,$partner,$aId));
      return "報名完成";
   }
   public function update_act_join_num($db,$aId,$join_total){
      $result2 = $db->prepare("UPDATE `act` SET `join_num`=`join_num`+? WHERE `aId` = ?");
      $result2->execute(array($join_total,$aId));
      return "資料更新完成";
   }
}
?>
