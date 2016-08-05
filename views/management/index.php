<?php 
    date_default_timezone_set("Asia/Taipei"); 

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
        <script type="text/javascript" src="/booking/jquery.js"></script>
        <script type="text/javascript">
          // window.setInterval(immediat(), 20);
            // setInterval(immediat(), 5000);//每10秒刷新夜面
            $(document).ready(immediat);
            var int=self.setInterval("immediat()",5000)//每5秒刷新夜面
            function immediat(){
                 for(var i = 1 ; i <= $("#show_act").find("tr").length-3 ; i++){
                    var aId = $("#show_act tr").eq(i).find("div").prop("id");//取得aId值
                    
                 res(i,aId);
                 
    
                }
            }
            function res(i,aId){
                   $.get("MData/show_join_imm?aId="+aId,function(data) {
                        $("#show_act tr").eq(i).find("div").text(data);
                    });
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
        <!--<input id="show_act_imm" value="查無資料">-->
        
         <table  style="border:3px #FFAC55 dashed;padding:5px;" rules="all" cellpadding='5' ="500" align="center" id="show_act";>
            <tr>
                <td><center>
                    <strong>活動名稱</strong>
                </center></td>
                <td><center>
                    <strong>報名狀態</strong>
                </center></td>
                <td><center><strong>報名網址</strong></center></td>
                <td width="120"><center>
                    <strong>已報名名單</strong><br>
                    <font size =2>(已報名/總人數)</font>
                </center></td>
                <td><center>
                    <strong>編輯</strong>
                </center></td>
                <td><center>
                    <strong>可報名名單</strong>
                </center></td>
                <td><center>
                    <strong>刪除</strong>
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
                <td><center><a href="https://missing-meng-zhu.c9users.io/booking/Home/show_act?aId=<?php echo $key['aId'] ?>">
                    https://missing-meng-zhu.c9users.io/booking/Home/show_act?aId=<?php echo $key['aId'] ?></a>
                </center></td>
                <td><center>
                     <a href="MData/show_join?aId=<?php echo $key['aId'];?>">
                     <div id="<?php echo $key['aId'];?>"><strong>讀取中...</strong></div>
                     </a>
                </center></td>
                <td><center>
                     <a  href="MHome/update_act?aId=<?php echo $key['aId'];?>"> <input type="button" value="編輯"></a>
                </center></td>
                <td><center>
                     <a  href="MHome/can_join?aId=<?php echo $key['aId'];?>"> <input type="button" value="可報名人員"></a>
                </center></td>
                <td><center>
                     <input type="button" value="刪除" onclick="check(<?php echo $key['aId'];?>)">
                </center></td>
            </tr>
            <?php } ?>
            <tr>
                <td COLSPAN=7><center>
                    <a href="MHome/create_act"> <button type="button" class="btn btn-info">建立新活動</button></a>
                </center></td>
                
            </tr>
            <tr>
                <td COLSPAN=7><center>
                    <a href="MData/logout"> <button type="button" class="btn btn-info">登出</button></a>
                </center></td>
            </tr>
              
        </table>
        
       
    </body>
</html>