<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript" src="../jquery.js"></script>
    <script type="text/javascript">
      
        function checkData(){
           var account = $("#account").val();
           var password = $("#password").val(); 
          $.get('../MData/login?account='+account+'&password=' + password ,res)
        
        }function res(data) {
          if(data=="帳號或密碼輸入錯誤"){
                alert(data);
          }else{
              window.location.href='../MHome';
          }
        }
    </script>
   

    <meta charset="utf-8">
    <title>挑戰題-booking</title>
</head>

<body>

    <h3 class="panel-title">管理者登入</h3>

    <form role="form"  action="../MData/login" method="post">
        <fieldset>
            <div class="form-group">
                <input class="form-control" placeholder="請輸入帳號" name="account" type="text" id="account" autofocus>
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="請輸入密碼" name="password" type="password" id="password" value="" pattern="[A-z 0-9]{3,20}">
            </div>
            <!-- Change this to a button or input when using this as a form -->
            <button type="button" class="btn btn-lg btn-success btn-block" id="checkbtn" name="login" onclick="checkData()">登入</button>
        </fieldset>
    </form>
                 
 

</body>

</html>
