<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
class employee
{
   /* 確認是否有此員工 */
   public function check_employee($db,$type,$employee){
      if($type == "eId"){
          $result = $db->prepare("SELECT * FROM `employee` WHERE `eId` = ?");
      }else{
         $result = $db->prepare("SELECT * FROM `employee` WHERE `name` = ?");
      }
      $result->execute(array($employee));//依序取代sql中"?"的值，並執行
      $row = $result->fetchAll();
     
     
      return $row;
     
     
      
   }
   
}
?>
