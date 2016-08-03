<?php  date_default_timezone_set("Asia/Taipei"); ?>
<html>
    <head>
        <script type="text/javascript" src="../jquery.js"></script>
        <script type="text/javascript">
          
            function checkData(){
               var aId = $("#aId").val(); 
               var name = $("#name").val();
               var body = $("#body").val(); 
               var num = $("#num").val();
               var partner = $("#partner:checked").val();
               var date_s = $("#date_s").val();
               var time_s = $("#time_s").val(); 
               var date_f = $("#date_f").val();
               var time_f = $("#time_f").val(); 
            //   alert(partner);
              if(name!='' && num!=''){
                    $.get('../MData/update_act?aId='+aId+'&name='+name+'&body=' + body+'&num=' + num+'&partner=' + partner+'&date_s=' + date_s+'&time_s=' + time_s+'&date_f=' + date_f+'&time_f=' + time_f ,res)
              }else{
                  alert("資料輸入不完全");
              }
            }function res(data) {
               window.location.href='../MHome';
            }
        </script>
        <meta charset="utf-8">
        <title>挑戰題-Booking</title>
    </head>
    <body>
         <table  style="border:3px #FFAC55 dashed;padding:5px;" rules="all" cellpadding='5' align="center";>
             <?php foreach($data as $key){?>
             <form role="form"  action="../MData/update_act?aId=<?php echo $key['aId'];?>" method="post">
                <input type="hidden" name="aId" id="aId" value="<?php echo $key['aId'];?>">
                <tr>
                    <td>
                        <label>活動名稱</label>
                    </td>
                    <td>
                        <input class="form-control" placeholder="活動名稱" id="name" name="name" value="<?php echo $key['name'];?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>活動概述</label>
                    </td>
                    <td>
                        <textarea rows="5" cols="50" id="body" name="body"><?php echo $key['body'];?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>人數限制(總數量)</label>
                    </td>
                    <td>
                        <input type="number" class="form-control" placeholder="人數限制(總數量)" id="num" name="num" pattern="[0-9]{1,5}" value="<?php echo $key['num'];?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>是否可攜伴</label>
                    </td>
                    <td>
                        <?php if($key['partner']=='y'){?>
                        <div class="radio">
                            <label>
                                <input type="radio" name="partner" id="partner" value="y" checked>可
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="partner" id="partner" value="n">不可
                            </label>
                        </div>
                        <?php }else{ ?>
                        <div class="radio">
                            <label>
                                <input type="radio" name="partner" id="partner" value="y" >可
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="partner" id="partner" value="n" checked>不可
                            </label>
                        </div>
                        <?php }?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>開始報名日期</label>
                    </td>
                    <td>
                        <input  type="date" class="form-control" placeholder="開始報名日期" id="date_s" name="date_s" value="<?php echo $key['date_s'];?>">
                    </td>
                </tr>    
                <tr>
                    <td>
                        <label>開始時間</label>
                    </td>
                    <td>
                        <input  type="time" class="form-control" placeholder="開始報名時間" id="time_s" name="time_s" value="<?php echo $key['time_s'];?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>截止日期</label>
                    </td>
                    <td>
                        <input  type="date" class="form-control" placeholder="截止日期" id="date_f" name="date_f" value="<?php echo $key['date_f'];?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>截止時間</label>
                    </td>
                    <td>
                        <input  type="time" class="form-control" placeholder="截止報名時間" id="time_f" name="time_f" value="<?php echo $key['time_f'];?>">
                    </td>
                </tr>   
                <tr>
                    <td COLSPAN=2><CENTER>
                        <button type="button" class="btn btn-default" id="checkbtn" onclick="checkData()">確認送出</button>
                    </CENTER></td>
                </tr>
                <tr>
                    <td COLSPAN=2><CENTER>
                        <button type="reset" class="btn btn-default" id="resetbtn" onclick="history.back()">取消編輯</button>
                    </CENTER></td>
                </tr>
                
            </form>
            <?php } ?>
        </table>
    </body>
</html>