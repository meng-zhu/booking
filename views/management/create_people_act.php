<html>
    <head>
         <meta charset="utf-8">
        <title>挑戰題-Booking</title>
    </head>
    <body>

         <form role="form"  action="../Data/create_people_act?aId=<?php echo $data;?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>活動名稱：<?php echo $data2." ID:".$data;?></label>
            </div>
            <div class="form-group">
                <label>可報名的編號</label>
                <input class="form-control" placeholder="可報名的編號" id="num" name="num">
            </div>
            <div class="form-group">
                <label>員工名稱</label>
                <input class="form-control" placeholder="可報名的編號" id="name" name="name">
            </div>
            <button type="submit" class="btn btn-default" id="checkbtn">確認送出</button>
            
            <button type="reset" class="btn btn-default" id="resetbtn" onclick="javascript:location.href='create_act_list'">回上一頁</button>
        </form>
    </body>
</html>