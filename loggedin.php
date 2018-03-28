<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/26
 * Time: 3:09 PM
 */
include_once 'class_lib.php';
if(!isset($_SESSION['Id'])){
    header('location:index.php');
}
$Id = $_SESSION['Id'];
$Username   = $_SESSION['Username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Php Exercise</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <style>
        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--a class="navbar-brand" href="#">Logo</a-->
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" id="createNewPost"><span class="glyphicon glyphicon-plus"></span>New Post </a> </li>
                <li><a href="#" id="myProfile"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
                <li><a href="#" id="Logout"><span class="glyphicon glyphicon-log-out"></span>Logout</a> </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container text-center">
    <div class="row">
        <div class="col-sm-3 well">
            <div class="well">
                <p>You are logged in as <?php echo $Username ?></p>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="row">
                <div class="col-sm-12">
                    <div id="showPosts"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-2 well">
            <?php echo date("Y-m-d H:i:s") ?>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="newPostModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <label for="newPost">New Post</label>
                    <textarea class="form-control" rows="5" id="NewPost"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="button" id="Post" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> Post</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myProfileModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="FirstName">First Name</label>
                        <input type="text" class="form-control" id="FirstName"/>
                    </div>
                    <div class="form-group">
                        <label for="LastName">Last Name</label>
                        <input type="text" class="form-control" id="LastName"/>
                    </div>
                    <div class="form-group">
                        <label for="EmailAddress">Email Address</label>
                        <input type="text" class="form-control" id="EmailAddress"/>
                    </div>
                    <div class="form-group">
                        <label for="UserName">Username</label>
                        <input type="text" class="form-control" id="UserName"/>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" placeholder="Password" id="Password"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="button" id="UpdateUser" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span> Update</button>
                    <input type="hidden" id="UserId">
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="container-fluid text-center">
    <p>Php Exercise</p>
</footer>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        refreshData();
        $('#createNewPost').click(function () {
            $('#newPostModal').modal();
        });
    });

    function showPosts() {
        var Data    = {Process:'showPosts'};
        $.post('functions.php',Data,function(Data) {
            var JsonObject = JSON.parse(Data);
            var showPosts = '';
            $.each(JsonObject,function(i,item){
                showPosts += '<div class="row"><div class="col-sm-12"><div class="well"><p>'+JsonObject[i].User+' ' + JsonObject[i].PostTmeStamp +'<br/>'+JsonObject[i].PostText+'</p></div></div></div>';
            });
            $('#showPosts').html(showPosts);
        });
    }

    $('#Logout').on('click',function () {
        var Data = {Process:'Logout'};
       $.post('functions.php',Data, function(Data) {
           if(Data){
               window.location.href = Data;
           }
       })
    });

    $('#Post').on('click',function () {
        var UserId      = '<?php echo $Id ?>';
        var NewPost = $('#NewPost').val();
        //alert(UserId + ' ' + NewPost);
        var Data    = {Process:'addPost',UserId:UserId,NewPost:NewPost};
        $.post('functions.php', Data, function () {
            $('#NewPost').val();
            showPosts();
            $('#newPostModal').modal('hide')
        })
    });

    $('#myProfile').on('click',function () {
        loadUserDetails(<?php echo $Id ?>);
    });

    function loadUserDetails(Id) {
        $('#UserId').val(Id);
        var Data = {Process:'loadUser',Id:Id};
        $.post('functions.php',Data,function(Data) {
            var JsonObject = JSON.parse(Data);
            $('#FirstName').val(JsonObject.FirstName);
            $('#LastName').val(JsonObject.LastName);
            $('#EmailAddress').val(JsonObject.EmailAddress);
            $('#UserName').val(JsonObject.Username);
        });
        $("#myProfileModal").modal("show");
    }

    $('#UpdateUser').on('click',function () {
        updateUserDetails()
    });

    function updateUserDetails() {
        var Id              = $('#UserId').val();
        var FirstName       = $('#FirstName').val();
        var LastName        = $('#LastName').val();
        var EmailAddress    = $('#EmailAddress').val();
        var Username        = $('#UserName').val();
        var Password        = $('#Password').val();
        var Data            = {Process:'UpdateUser',Id:Id,FirstName:FirstName,LastName:LastName,EmailAddress:EmailAddress,Username:Username,Password:Password};
        console.log(Data);
        $.post('functions.php',Data,function () {
            $("#myProfileModal").modal("hide");
            $('#UserId').val('');
            $('#FirstName').val('');
            $('#LastName').val('');
            $('#EmailAddress').val('');
            $('#UserName').val('');
            $('#Password').val('');
            showPosts();
        })
    }

    function refreshData() {
        var Time = 15;
        showPosts();
        setTimeout(refreshData, Time*1000);
    }
</script>