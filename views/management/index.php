<?php 
    session_start();
    header("Content-Type:text/html; charset=utf-8");
    
    $uId = $_SESSION['uId'];
    if($uId==null){
        //echo "請登入會員";
        header("Location:MHome/login");
        exit();
    }
?>
<html>
    <head>
        <script type="text/javascript" src="../jquery.js"></script>
        <script type="text/javascript">
          
            function immediat(){//即時報名人數
                
            }
            function check(aId){
                if(confirm("真的要刪除這項活動？"))
                {
                    document.location.href="MData/delete_act?aId="+aId;
                }
            }
        </script>
        <title>挑戰題-booking</title>
        <meta charset="utf-8">
    </head>
    <body>
         <table  style="border:3px #FFAC55 dashed;padding:5px;" rules="all" cellpadding='5' width="500" align="center";>
            <tr>
                <td><center>
                    活動名稱
                </center></td>
                <td><center>
                    報名狀態
                </center></td>
                <td><center>
                    已報名名單
                </center></td>
                <td><center>
                    編輯
                </center></td>
                <td><center>
                    可報名名單
                </center></td>
                <td><center>
                    刪除
                </center></td>
            </tr>
            <?php foreach($data as $key){?>
            <tr>
                <td><center>
                    <?php echo $key['name']; ?>
                </center></td>
                <td><center>
                    <?php 
                        $date_s = $key['date_s'];$num_date_s = strtotime ($date_s);
                        $time_s = $key['time_s'];$num_time_s = strtotime ($time_s);
                        $date_f = $key['date_f'];$num_date_f = strtotime ($date_f);
                        $time_f = $key['time_f'];$num_time_f = strtotime ($time_f);
                        $start = $date_s." ".$time_s;
                        $end = $date_f." ".$time_f;
                        $start_num = strtotime ($start);
                        $end_num = strtotime ($end);
                  
                        $now = date('Y-m-d G:i');
                        $now_num = strtotime ($now);
                        
                        if($start_num <= $now_num && $end_num > $now_num){
                            echo "開放報名中";
                        }elseif($start_num > $now_num ){
                            echo "尚未開放報名";
                        }else{
                            echo "報名截止";
                        }
                        
                    ?>    
                </center></td>
                <td><center>
                     <a href="#?aId=<?php echo $key['aId'];?>"><?php echo "已報名人數/".$key['num']?></a>
                </center></td>
                <td><center>
                     <a  href="MHome/update_act?aId=<?php echo $key['aId'];?>"> <input type="button" value="編輯"></a>
                </center></td>
                <td><center>
                     <a  href="#?aId=<?php echo $key['aId'];?>&name=<?php echo $key['name'];?>"> <input type="button" value="可報名人員"></a>
                </center></td>
                <td><center>
                     <input type="button" value="刪除" onclick="check(<?php echo $key['aId'];?>)">
                </center></td>
            </tr>
            <?php } ?>
            <tr>
                <td COLSPAN=6><center>
                    <a href="MHome/create_act"> <button type="button" class="btn btn-info">建立新活動</button></a>
                </center></td>
                
            </tr>
            <tr>
                <td COLSPAN=6><center>
                    <a href="MData/logout"> <button type="button" class="btn btn-info">登出</button></a>
                </center></td>
            </tr>
                
        </table>
        
       
    </body>
</html>