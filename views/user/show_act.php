<?php 
date_default_timezone_set("Asia/Taipei"); 
?>
<html>
    <head>
        <script type="text/javascript" src="../jquery.js"></script>
        <script type="text/javascript">
          
            function join(){
                var aId = $("#aId").val(); 
                var partner = $("#partner").val();
                var num;
                var insert_partner;
                if(num=prompt("請輸入員工編號"))
                {  
                    if(partner == 'y'){//可以攜伴
                        if(insert_partner=prompt("請輸入攜伴人數","0")){
                            //alert("你按下確認，員工編號為：："+num+" 攜伴人數："+partner);
                             $.get("../UData/join_act?aId="+aId+"&num="+num+"&partner="+insert_partner,res);
                        }else
                        {
                            alert("報名失敗");
                        }
                    }else{//不能攜伴
                        $.get("../UData/join_act?aId="+aId+"&num="+num,res);
                    }
                }
                else
                {
                    alert("報名失敗");
                } 
                
            }
            function res(data){
              
                alert(data); 
                window.location.href="../Home/show_act?aId="+$("#aId").val();
            
                
            }
        </script>
        
        <title>挑戰題-booking</title>
        <meta charset="utf-8">
    </head>
    <body>
         <?php foreach($data as $key){?>
         <input type="hidden" name="aId" id="aId" value="<?php echo $key['aId'];?>">
         <input type="hidden" name="partner" id="partner" value="<?php echo $key['partner'];?>">
         <table  style="border:3px #FFAC55 dashed;padding:5px;" rules="all" cellpadding='5' width="1000" align="center";>
            <tr>
                <td><CENTER>
                    活動名稱
                </CENTER></td>
                <td><CENTER>
                    活動概述
                </CENTER></td>
                <td><CENTER>
                    活動人數限制
                </CENTER></td>
                <td><CENTER>
                    是否可攜伴
                </CENTER></td>
                <td><CENTER>
                    報名時間
                </CENTER></td>
              
            </tr>
            
            <tr>
                <td><CENTER>
                    <?php echo $key['name']; ?>
                </CENTER></td>
                <td><CENTER>
                    <?php echo $key['body']; ?>
                </CENTER></td>
                <td><CENTER>
                    <?php echo $key['join_num']."/".$key['num']?>
                </CENTER></td>
                <td><CENTER>
                    <?php echo $key['partner']; ?>
                </CENTER></td>
                <td><CENTER>
                    <?php echo $key['date_s']."<br>".$key['time_s']."<br>至<br>".$key['date_f']."<br>".$key['time_f'];?>
                </CENTER></td>
               
                
            </tr>
            <tr>
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

                    $num = $key['num'];
                    $join_num = $key['join_num'];
                    
                    if($start_num <= $now_num && $end_num > $now_num){
                        if( $num > $join_num ){
                ?>
                        <td COLSPAN=5><CENTER><input type="button" value="我要報名" onclick="join()"></CENTER></td>
                        
                <?php    }else{ ?>
                        <td COLSPAN=5><CENTER><input type="button" value="名額已滿" disabled></CENTER></td>
                <?php    } 
                    }else{ ?>
                        <td COLSPAN=5><CENTER><input type="button" value="我要報名" disabled></CENTER></td>
                <?php } ?>
               
            </tr>
            <tr>
                 <td COLSPAN=5><CENTER><input type="button" value="回上一頁" onclick="history.back()"></CENTER></td>
            </tr>
        </table>
        <?php } ?>
       
    </body>
</html>