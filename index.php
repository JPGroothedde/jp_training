<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/14
 * Time: 2:48 PM
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fibonacci</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>
<input type="text" id="fiboMaxInput"/>
<button id="fiboMaxInputSubmit">Submit</button>
<div id="response"></div>
</body>
<script type="text/javascript" src="assets/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript">
$('#fiboMaxInputSubmit').click(function(){
    var fiboMax = $('#fiboMaxInput').val();
    var data    = {fiboMax:fiboMax};
    $.post('task_5.php', data, function(data){
        $('#response').html(data);
    });
});
</script>
</html>