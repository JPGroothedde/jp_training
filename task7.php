<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/16
 * Time: 11:37 AM
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Task 7</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>
<!-- Content Section -->
<div class="container">
    <div class="row pull-right">
        <a href="#" data-toggle="modal" data-target="#addNewPersonModal"><span class="glyphicon glyphicon-plus"></span></a>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="PersonGrid">
                <thead>
                    <tr>
                        <th colspan="8"><h5>Person Grid</h5></th>
                    </tr>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Date Of Birth</th>
                        <th>Email Address</th>
                        <th>Age</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <ul class="pagination" id="PersonGridPagination">
            <!--li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li-->
        </ul>
    </div>
</div>
<!-- Bootstrap Modal - To Add New Record -->
<!-- Modal -->
<div class="modal fade" id="addNewPersonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" id="Name" placeholder="Name" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="Surname">Last Name</label>
                    <input type="text" id="Surname" placeholder="Surname" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="DateOfBirth">Date Of Birth</label>
                    <input data-provide="datepicker" data-date-format="yyyy-mm-dd" type="date" id="DateOfBirth" placeholder="Date Of Birth" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="EmailAddress">Email Address</label>
                    <input type="text" id="EmailAddress" placeholder="Email Address" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="Age">Age</label>
                    <input type="text" id="Age" placeholder="Age" class="form-control"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addPerson()">Add Record</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal - Update User details -->
<div class="modal fade" id="UpdatePersonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="UpdateName">Name</label>
                    <input type="text" id="UpdateName" placeholder="Name" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="UpdateSurname">Last Name</label>
                    <input type="text" id="UpdateSurname" placeholder="Surname" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="UpdateDateOfBirth">Date Of Birth</label>
                    <input data-provide="datepicker" data-date-format="yyyy-mm-dd" type="date"  id="UpdateDateOfBirth" placeholder="Date Of Birth" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="UpdateEmailAddress">Email Address</label>
                    <input type="text" id="UpdateEmailAddress" placeholder="Email Address" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="UpdateAge">Age</label>
                    <input type="text" id="UpdateAge" placeholder="Age" class="form-control"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updatePersonDetails()" >Save Changes</button>
                <input type="hidden" id="PersonId">
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    loadPersonTable();
});
function loadPersonTable() {
    var Data    = {Process:'loadAll'};
    $.post("../task6/task_6.php",Data,function(Data) {
        var JsonObject = JSON.parse(Data);
        var JsonObjectLength = JsonObject.length;
        //alert(JsonObjectLength);
        var PopulateTable = '';
        $.each(JsonObject, function(i, item) {
            PopulateTable += '<tr><td>'+JsonObject[i].Id+'</td><td>'+JsonObject[i].Name+'</td><td>'+JsonObject[i].Surname+'</td><td>'+JsonObject[i].DateOfBirth+'</td><td>'+JsonObject[i].EmailAddress+'</td><td>'+JsonObject[i].Age+'</td><td>'+'<a href="#" onclick="loadPersonDetails('+JsonObject[i].Id+')"><span class="glyphicon glyphicon-pencil"></span></a>'+'</td>'+'<td>'+'<a href="#" onclick="deletePerson('+JsonObject[i].Id+')"><span class="glyphicon glyphicon-trash"></span></a>'+'</td></tr>';
        });
        $('#PersonGrid tbody').html(PopulateTable);

    });
}


function loadPersonDetails(Id) {
    $('#PersonId').val(Id);
    var Data = {Process:'LoadPerson',Id:Id};
    $.post('../task6/task_6.php',Data,function(Data) {
        var JsonObject = JSON.parse(Data);
        $('#UpdateName').val(JsonObject.Name);
        $('#UpdateSurname').val(JsonObject.Surname);
        $('#UpdateDateOfBirth').val(JsonObject.DateOfBirth);
        $('#UpdateEmailAddress').val(JsonObject.EmailAddress);
        $('#UpdateAge').val(JsonObject.Age);
    });
    $("#UpdatePersonModal").modal("show");
}
function deletePerson(Id) {
    //alert('Delete '+Id);
    var Confirm = confirm("Are you sure, do you really want to delete User?");
    var Data    = {Process:'Delete',Id: Id};
    if (Confirm == true) {
        $.post('../task6/task_6.php',Data,function () {
            loadPersonTable();
        });
    }
}
function addPerson() {
    var Name            = $('#Name').val();
    var Surname         = $('#Surname').val();
    var DateOfBirth     = $('#DateOfBirth').val();
    var EmailAddress    = $('#EmailAddress').val();
    var Age             = $('#Age').val();
    var Data            = {Process:'add',Name:Name,Surname:Surname,DateOfBirth:DateOfBirth,EmailAddress:EmailAddress,Age:Age};
    console.log(Data);
    $.post('../task6/task_6.php',Data,function(){
        $('#addNewPersonModal').modal("hide");
        $('#Name').val('');
        $('#Surname').val('');
        $('#DateOfBirth').val('');
        $('#EmailAddress').val('');
        $('#Age').val('');
        loadPersonTable();
    });
}
function updatePersonDetails() {
    var Id              = $('#PersonId').val();
    var Name            = $('#UpdateName').val();
    var Surname         = $('#UpdateSurname').val();
    var DateOfBirth     = $('#UpdateDateOfBirth').val();
    var EmailAddress    = $('#UpdateEmailAddress').val();
    var Age             = $('#UpdateAge').val();
    var Data            = {Process:'Update',Id:Id,Name:Name,Surname:Surname,DateOfBirth:DateOfBirth,EmailAddress:EmailAddress,Age:Age};
    $.post('../task6/task_6.php',Data,function () {
        $("#UpdatePersonModal").modal("hide");
        $('#PersonId').val('');
        $('#UpdateName').val('');
        $('#UpdateSurname').val('');
        $('#UpdateDateOfBirth').val('');
        $('#UpdateEmailAddress').val('');
        $('#UpdateAge').val('');
        loadPersonTable();
    })
}
</script>
</body>
</html>