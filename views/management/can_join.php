<html>
    <head>
        <script type="text/javascript" src="../jquery.js"></script>
        <script type="text/javascript">
          
            function check(){
                var aId = $("#aId").val();
                var type = $("#type option:selected").text();//先抓到選擇項目
                var employee = $("#employee").val();//輸入內容
                $.get("../MData/can_join?aId="+aId+"&type="+type+"&employee="+employee,res);
            }
            function res(data){
                alert(data);
            }
         </script>
         <meta charset="utf-8">
        <title>挑戰題-Booking</title>
    </head>
    <body>
        <table  style="border:3px #FFAC55 dashed;padding:5px;" rules="all" cellpadding='5' width="500" align="center";>
            <form role="form"  action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="aId" id="aId" value="<?php  echo $data;?>">    
            <tr>
                <td  COLSPAN=2><CENTER><strong>
                     活動名稱：<?php echo $data2 ?>
                </strong></CENTER></td>
            </tr>
            <tr>
               <td><CENTER>
                    <select  id="type" name="type">
                        <option>員工編號</option>
                        <option>員工名稱</option>
                    </select>
                </CENTER></td>
               <td>
                    <input class="form-control" placeholder="可報名人員資料" id="employee" name="employee">
               </td>
            </tr>
            <tr>
                <td  COLSPAN=2><CENTER>
                     <button type="button" class="btn btn-default" id="checkbtn" onclick="check()">確認送出</button>
                </CENTER></td>
            </tr>
            <tr>
                <td  COLSPAN=2><CENTER>
                    <button type="reset" class="btn btn-default" id="resetbtn" onclick="history.back()">回上一頁</button>
                </CENTER></td>
            </tr>
            </form>
        </table>
      
    </body>
</html>