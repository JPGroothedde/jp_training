<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/13
 * Time: 8:24 AM
 */
include 'class_lib.php';

$Time = microtime();
$Time = explode(' ', $Time);
$Time = $Time[1] + $Time[0];
$Start = $Time;

$Name          = 'Test';
$Surname       = 'Test';
$DateOfBirth   = '1999-09-09';
$EmailAddress  = 'test@test.com';
$Age           = '88';

//Deletes all people from db
//$PersonObject   = PersonManagement::deleteAllPeople();

//Updates person details by Id
$PersonObject = new Person('1','Lappies','Landmyn','1901-01-01','lappies@test.com','66');
//$PersonObject->Name = 'Nie Lappies nie';
$PersonObject ->savePerson();
if(!is_null($PersonObject)){
    //echo $PersonObject -> getJson();
} else {
    echo 'Not saved.';
}

//Deletes person from db by Id
$PersonObject  = new Person('10');
$PersonObject ->deletePerson();
if(!is_null($PersonObject)){
    //echo $PersonObject->getJson();
}else{
    echo 'Not deleted';
}

//Add 10 people
$PersonObject     = new Person('',$Name,$Surname,$DateOfBirth,$EmailAddress,$Age);
for($i = 0;$i<10;$i++) {
    //$PersonObject -> savePerson();
}
if (!is_null($PersonObject)){
    //echo $PersonObject -> getJson();
} else {
    echo 'Not created.';
}

//Loads a person from db by Id
//$PersonObject = PersonManagement::loadPerson('1');
if(!is_null($PersonObject)){
    //echo $PersonObject->getJson();
} else {
    //echo 'Not found.';
}

//Loads all people in db.
$PersonObject = PersonManagement::loadAllPeople();
if(!empty($PersonObject)) {
    foreach ($PersonObject AS $Person) {
        echo $Person->getJson();
    }
}

$Time = microtime();
$Time = explode(' ', $Time);
$Time = $Time[1] + $Time[0];
$Finish = $Time;
$TotalTime = round(($Finish - $Start), 4);
//echo 'Page generated in '.$TotalTime.' seconds.';
?>