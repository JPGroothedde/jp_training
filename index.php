<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/26
 * Time: 11:00 AM
 */
include 'class_lib.php';
if(isset($_SESSION['Id'])){
    header('location:loggedin.php');
}
$HashedPassword = password_hash('123',PASSWORD_BCRYPT);
//echo $HashedPassword;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <form class="form-horizontal" method="POST" id="login_form" name="login">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h2>User Login</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group has-danger">
                        <div class="input-group">
                            <input type="text" name="Username" class="form-control" id="Username" placeholder="Username" autocomplete="off" required autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" name="Password" class="form-control" id="Password" placeholder="Password" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <a href="#" id="SubmitLogin"><span class=" glyphicon glyphicon-log-in"></span> Login</a>
                        <label class="form-check-label"><span class="text-danger align-middle" id="errorMsg"></span></label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('#SubmitLogin').on('click',function () {
        SubmitLogin();
    });
    function SubmitLogin(){
        var Process     = 'Login';
        var Username    = $('#Username').val();
        var Password    = $('#Password').val();
        if(Username === '' || Password === ''){
            alert('Please supply a username and password');
        }else {
            var Data = {Process: Process, Username: Username, Password: Password};
            $.post('functions.php', Data, function (Data) {
                window.location.href = Data;
            });
        }
    }
</script>