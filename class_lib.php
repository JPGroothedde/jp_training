<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/26
 * Time: 11:43 AM
 */
session_start();
class User {
    private $Connect;
    public $UserId;
    public $NewPost;
    public $PostText;
    public $PostTimeStamp;
    public $User;
    public $PostId;
    public $FirstName;
    public $LastName;
    public $EmailAddress;
    public $Username;
    public $Password;
    public $now;
    public function __construct($UserId = null, $NewPost = null, $PostText = null, $PostTimeStamp = null, $User = null, $PostId = null, $FirstName =null, $LastName = null, $EmailAddress = null, $Username = null, $Password = null) {
        $this->UserId           = $UserId;
        $this->NewPost          = $NewPost;
        $this->PostText         = $PostText;
        $this->PostTimeStamp    = $PostTimeStamp;
        $this->User             = $User;
        $this->PostId           = $PostId;
        $this->FirstName        = $FirstName;
        $this->LastName         = $LastName;
        $this->EmailAddress     = $EmailAddress;
        $this->Username         = $Username;
        $this->Password         = $Password;
        $this->now              = date("Y-m-d H:i:s");
        $this->Connect = PostManagement::getDatabaseConnection();
    }
    public function getJson() {
        return json_encode($this->getArray());
    }
    public function getArray() {
        return array("UserId" => $this->UserId, "PostId"=>$this->PostId, "PostText" => $this->PostText, "PostTmeStamp" => $this->PostTimeStamp,"User"=>$this->User,"FirstName"=>$this->FirstName,"LastName"=>$this->LastName,"EmailAddress"=>$this->EmailAddress,"Username"=>$this->Username,"Password"=>$this->Password);
    }

    public function Login($Username, $Password) {
        $stmt = $this->Connect->prepare("SELECT * FROM `Users` WHERE `Username` = ?");
        $stmt->bind_param("s",$Username);
        $stmt->execute();
        $Result = $stmt->get_result();
        $Hash = '';
        while ($Row = $Result->fetch_assoc()) {
            $Hash   = $Row['Password'];
            if(password_verify($Password,$Hash)) {
                $_SESSION['Id'] = $Row['Id'];
                $_SESSION['Username'] = $Row['Username'];
                return true;
            } else {
                return false;
            }
        }
    }

    public function Logout() {
        $_SESSION['Id'] = '';
        $_SESSION['Username'] = '';
        session_destroy();
        return true;
    }

    public function addPost() {
        $stmt   = $this->Connect->prepare("INSERT INTO `Posts`(`PostTimeStamp`,`PostText`,`UserId`) VALUES (?,?,?)");
        $stmt->bind_param("ssi",$this->now,$this->NewPost,$this->UserId);
        $stmt->execute();
        return true;
    }
    public function updateUser(){
        if(!empty($this->Password)){
            $Password = password_hash($this->Password,PASSWORD_BCRYPT);
            $stmt = $this->Connect->prepare("UPDATE `Users` SET `FirstName` = ?,`LastName` = ?,`EmailAddress` = ?,`Username` = ?,`Password` = ? WHERE Id = ?");
            $stmt->bind_param("sssssi",$this->FirstName,$this->LastName,$this->EmailAddress,$this->Username,$Password,$this->UserId);
            $stmt->execute();
        }else{
            $stmt = $this->Connect->prepare("UPDATE `Users` SET `FirstName` = ?,`LastName` = ?,`EmailAddress` = ?,`Username` = ? WHERE Id = ?");
            $stmt->bind_param("ssssi",$this->FirstName,$this->LastName,$this->EmailAddress,$this->Username,$this->UserId);
            $stmt->execute();
        }

    }

}
abstract class PostManagement {
    public static function getDatabaseConnection() {
        return mysqli_connect('localhost', 'root','','phpExercise');
    }
    public static function loadUser($UserId){
        $Connection = self::getDatabaseConnection();
        $stmt = $Connection->prepare("SELECT * FROM `Users` WHERE `Id` = ?");
        $stmt->bind_param('i', $UserId);
        $stmt->execute();
        $Result = $stmt->get_result();
        $UserObject = null;
        while ($Row = $Result->fetch_assoc()) {
            $UserObject = new User($Row['Id'],'','','','','',$Row['FirstName'],$Row['LastName'],$Row['EmailAddress'],$Row['Username'],$Row['Password']);
            break;
        }
        return $UserObject;
    }
    public static function showPosts() {
        $Connection = self::getDatabaseConnection();
        $stmt = $Connection->prepare("SELECT Posts.Id,Posts.PostText,Posts.PostTimeStamp,CONCAT(Users.FirstName,' ',Users.LastName) AS User FROM `Posts` LEFT JOIN Users  ON Posts.UserId = Users.Id ORDER BY Posts.PostTimeStamp DESC");
        $stmt->execute();
        $Result = $stmt->get_result();
        $PostArray = array();
        while ($Row = mysqli_fetch_assoc($Result)) {
            $PostObject = new User('', '',$Row['PostText'],$Row['PostTimeStamp'],$Row['User'],$Row['Id']);
            array_push($PostArray, $PostObject);
        }
        return $PostArray;
    }

}