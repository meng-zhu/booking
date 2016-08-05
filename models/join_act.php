<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
class join_act
{

   /* 報名名單 */
   public function show_join($db,$aId){
      $result = $db->prepare("SELECT * FROM `join` INNER JOIN `employee` USING (`eId`) WHERE `aId` = ?");
      $result->execute(array($aId));//依序取代sql中"?"的值，並執行
      $row = $result->fetchAll();
      return $row;
   }
   /* 確認有沒有報名過 */
   public function check_join($db,$eId,$aId){
      $result = $db->prepare("SELECT * FROM `join` WHERE `eId` = ? AND `aId` = ?");
      $result->execute(array($eId,$aId));//依序取代sql中"?"的值，並執行
      $row = $result->fetchAll();
      if(count($row)<1){
         return true;
      }else{
         return false;
      }
   }
   /* 報名 */
   public function join_act_insert($db,$eId,$partner,$aId){
     
         $result = $db->prepare("INSERT INTO `join`( `eId`, `partner`, `aId`) VALUES (?,?,?)");
         $result->execute(array($eId,$partner,$aId));
         return true;

   }
  
}
?>
