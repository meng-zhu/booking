<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
class can_join
{
    public function show_can_join($db,$eId,$name,$aId){
      $result = $db->prepare("SELECT * FROM `can_join` WHERE `eId` =? AND `aId` = ?" );
      $result->execute(array($eId,$aId));//依序取代sql中"?"的值，並執行
      $row = $result->fetchAll();
      if(count($row)<1){
            $result = $db->prepare("INSERT INTO `can_join`(`eId`, `name`, `aId`) VALUES (?,?,?)");
            $result->execute(array($eId,$name,$aId));//依序取代sql中"?"的值，並執行

            return true;
      }else{
            return false;
      }
      
   }
   public function check_can_join($db,$eId,$aId){
      $result = $db->prepare("SELECT * FROM `can_join` WHERE `eId` = ? AND aId = ?");
      $result->execute(array($eId,$aId));//依序取代sql中"?"的值，並執行
      $row = $result->fetchAll();
      if(count($row)>0){
          return true;
      }else{
          return false;
      }
   }
}