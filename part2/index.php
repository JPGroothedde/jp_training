<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/15
 * Time: 9:38 AM
 */

?>
<!DOCTYPE html>
<html>
<head>
    <title>Fibonacci Part 2</title>
</head>
<body>
<input type="text" id="fiboMaxInput"/>
<button id="fiboMaxInputSubmit" onclick="fibo()">Submit</button>
<div id="response"></div>
</body>
<script type="text/javascript">
function fibo(){
    var max     = document.getElementById('fiboMaxInput').value;
    var xhttp   = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById("response").innerHTML = this.responseText;
        }
    }
    xhttp.open("POST", "../task_5.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('fiboMax='+max);
}
</script>
</html>
