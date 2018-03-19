<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/15
 * Time: 1:30 PM
 */
class Person{
    private $Id;
    public $Name;
    public $Surname;
    public $DateOfBirth;
    public $EmailAddress;
    public $Age;
    private $Connect;
    public function __construct($Id = null,$Name = null,$Surname = null,$DateOfBirth = null,$EmailAddress = null,$Age = null) {
        $this->Id           = $Id;
        $this->Name         = $Name;
        $this->Surname      = $Surname;
        $this->DateOfBirth  = $DateOfBirth;
        $this->EmailAddress = $EmailAddress;
        $this->Age          = $Age;
        $this->Connect      = PersonManagement::getDatabaseConnection();
    }
    public function getJson(){
        $JSONArray = array("Id" => $this->Id,"Name" => $this->Name,"Surname" => $this->Surname,"DateOfBirth" => $this->DateOfBirth,"EmailAddress" => $this->EmailAddress,"Age" => $this->Age);
        return json_encode($JSONArray);
    }
    public function savePerson(){ //needs to be used for new person creation as well as editing.
        if($this->Id == null){
            $Sql = ("INSERT INTO `Person`
                 SET 
                `Name`          = '$this->Name',
                `Surname`       = '$this->Surname',
                `DateOfBirth`   = '$this->DateOfBirth',
                `EmailAddress`  = '$this->EmailAddress',
                `Age`           = '$this->Age'");
            $Result = mysqli_query($this->Connect,$Sql);
            if($Result){
                $Message = 'Inserted successfully....';
            }else{
                $Message = 'Insert failed....';
            }
        }elseif ($this->Id != null){
            //echo'Got Id';
            $Sql = ("UPDATE `Person`
                SET
                `Name`          = '$this->Name',
                `Surname`       = '$this->Surname',
                `DateOfBirth`   = '$this->DateOfBirth',
                `EmailAddress`  = '$this->EmailAddress',
                `Age`           = '$this->Age'
                WHERE Id = '$this->Id'");
            $Result = mysqli_query($this->Connect,$Sql);
            if($Result){
                $Message = 'Updated successfully....';
            }else{
                $Message = 'Update failed....';
            }
        }
        return $Message;
    }

    public function deletePerson(){
        if($this->Id != null){
            $Sql = "DELETE FROM `Person` WHERE `Id` = '$this->Id'";
            $Result = mysqli_query($this->Connect,$Sql);
            if($Result){
                $Message = 'Deleted successfully....';
            }else{
                $Message = 'Deleted successfully....';
            }
        }
        return $Message;
    }

    /*
    function createPerson() {
        $Sql = ("INSERT INTO `Person`
                 SET 
                `Name`          = '$this->Name',
                `Surname`       = '$this->Surname',
                `DateOfBirth`   = '$this->DateOfBirth',
                `EmailAddress`  = '$this->EmailAddress',
                `Age`           = '$this->Age'");
        $Result = mysqli_query($this->Connect, $Sql);
    }/*
    function savePerson($Name,$Surname,$DateOfBirth,$EmailAddress,$Age,$Id) {
        $Sql = ("UPDATE `Person`
                SET
                `Name`          = '$Name',
                `Surname`       = '$Surname',
                `DateOfBirth`   = '$DateOfBirth',
                `EmailAddress`  = '$EmailAddress',
                `Age`           = '$Age'
                WHERE id = '$Id'");
        $Result = mysqli_query($this->Connect,$Sql);
    }*/
}
abstract class PersonManagement {
    public static function getDatabaseConnection() {
        return mysqli_connect('localhost', 'root','','jp_training');
    }

    public function loadPerson($Id){
        $Sql = "SELECT * FROM `Person` WHERE `Id` = '$Id'";
        $Connection = self::getDatabaseConnection();
        $Result = mysqli_query($Connection,$Sql);
        $PersonObject = null;
        if (mysqli_num_rows($Result) > 0) {
            while($Row = mysqli_fetch_assoc($Result)) {
                $PersonObject = new Person($Row['Id'],$Row['Name'],$Row['Surname'],$Row['DateOfBirth'],$Row['EmailAddress'],$Row['Age']);
                //$CurrentPerson = array('Id'=>$Row['Id'],'Name'=>$Row['Name'],'Surname'=>$Row['Surname'],'Date Of Birth'=>$Row['DateOfBirth'],'Email Address'=>$Row['EmailAddress'],'Age'=>$Row['Age']);
                break;
            }
        }
        return $PersonObject;
    }

    public static function loadAllPeople(){
        $Sql = "SELECT * FROM `Person`";
        $Connection = self::getDatabaseConnection();
        $Result = mysqli_query($Connection,$Sql);
        $PeopleArray = array();
        $PersonObject = null;
        if (mysqli_num_rows($Result) > 0) {
            while($Row = mysqli_fetch_assoc($Result)) {
                $PersonObject = new Person($Row['Id'],$Row['Name'],$Row['Surname'],$Row['DateOfBirth'],$Row['EmailAddress'],$Row['Age']);
                array_push($PeopleArray,$PersonObject);
            }

        }
        return $PeopleArray;
    }

    /*
    public static function deletePerson($Id){
        $Sql = "DELETE FROM `Person` WHERE `Id` = '$Id'";
        $Connection = self::getDatabaseConnection();
        $Result = mysqli_query($Connection,$Sql);
        if($Result){
            $Message = 'Deleted successfully....';
        }else{
            $Message = 'Something went wrong....';
        }
        return $Message;
    }
    */
    public static function deleteAllPeople(){
        $Sql = "DELETE FROM `Person`";
        $Connection = self::getDatabaseConnection();
        $Result = mysqli_query($Connection,$Sql);
        if($Result){
            $Message = 'Deleted successfully....';
        }else{
            $Message = 'Something went wrong....';
        }
        return $Message;
    }
}