<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
class user
{
    public function login($db,$account,$password){
         // return $account;
         $result = $db->prepare("SELECT * FROM `user` WHERE `account` = ? AND `password` = ?");
         $result->execute(array($account, $password));//依序取代sql中"?"的值，並執行
         $row = $result->fetchAll();
         if(count($row)<1){
            return false;
         }else{
            foreach($row as $key){
               $_SESSION['uId'] = $key['uId'];
               return true;
         }
      }
   }
}
?>
