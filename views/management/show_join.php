<?php 
date_default_timezone_set("Asia/Taipei"); 
?>
<html>
    <head>
        <script type="text/javascript" src="../jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(immediat);
            var int=self.setInterval("immediat()",5000)//每5秒刷新夜面
            function immediat(){
                var aId = $("#aId").val();
                $.get("../MData/show_join_imm?aId="+aId,res);
                $.get("../MData/show_join_people?aId="+aId,show_join);
            }function res(data){
                $("#show_act_imm").html(data);
            }function show_join(data2){
                $("#show_join").html(data2);
            }
            
        </script>
        <title>挑戰題-booking</title>
        <meta charset="utf-8">
    </head>
    <body>
        
         <?php foreach($data as $key){?>
        <input type="hidden" name="aId" id="aId" value="<?php echo $key['aId'];?>">
         <table  style="border:3px #FFAC55 dashed;padding:5px;" rules="all" cellpadding='5' width="1000" align="center";>
            <tr>
                <td COLSPAN=5><CENTER><h2>活動內容</h2></CENTER></td>
            </tr>
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
                    <div id="show_act_imm"><strong>讀取中...</strong></div>
                </CENTER></td>
                <td><CENTER>
                    <?php echo $key['partner']; ?>
                </CENTER></td>
                <td><CENTER>
                    <?php echo $key['date_s']."<br>".$key['time_s']."<br>至<br>".$key['date_f']."<br>".$key['time_f'];?>
                </CENTER></td>
               
                
            </tr>
            <tr>
                 <td COLSPAN=5><CENTER><input type="button" value="回上一頁" onclick="history.back()"></CENTER></td>
            </tr>
        </table>
        <?php } ?>
        <div id="show_join"><center><h3><strong>
             資料讀取中，請耐心等候
        </strong></h3></center></div>
        
       
    </body>
</html>