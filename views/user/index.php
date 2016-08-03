<?php 
date_default_timezone_set("Asia/Taipei"); 
?>
<html>
    <head>
        <title>挑戰題-booking</title>
        <meta charset="utf-8">
    </head>
    <body>
       

　  <table  style="border:3px #FFAC55 dashed;padding:5px;" rules="all" cellpadding='5' width="500" align="center";>
        <tr>
            <td><center>活動名稱</center></td>
            <td><center>活動詳細資訊</center></td>
            <td><center>活動狀態</center></td>
        </tr>
         <?php foreach($data as $key){?>
        <tr>
            <td><center><?php echo $key['name']; ?></center></td>
            <td><center><a  href="Home/show_act?aId=<?php echo $key['aId'];?>"> <input type="button" value="點我查看"></a></center></td>
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
                    
                    // echo "開始時間: ".$start_num."<br>截止時間: ".$end_num."<br>現在時間: ".$now_num;
                    
                    
                    if($start_num <= $now_num && $end_num > $now_num){
                        echo "開放報名中";
                    }elseif($start_num > $now_num ){
                        echo "尚未開放報名";
                    }else{
                        echo "報名截止";
                    }
                    
                ?>
                 
                
                
            </center></td>
        </tr>
        <?php } ?>
      
    </table>
        　
        
       
    </body>
</html>