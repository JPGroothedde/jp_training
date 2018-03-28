<?php
/**
 * Created by PhpStorm.
 * User: stratusolve
 * Date: 2018/03/26
 * Time: 1:46 PM
 */
include 'class_lib.php';
if(isset($_POST)){
    $Process        = filter_input(INPUT_POST,'Process', FILTER_SANITIZE_STRING);
    $Username       = filter_input(INPUT_POST,'Username',FILTER_SANITIZE_STRING);
    $Password       = filter_input(INPUT_POST,'Password',FILTER_SANITIZE_STRING);
    $FirstName      = filter_input(INPUT_POST,'FirstName',FILTER_SANITIZE_STRING);
    $LastName       = filter_input(INPUT_POST,'LastName',FILTER_SANITIZE_STRING);
    $EmailAddress   = filter_input(INPUT_POST,'EmailAddress',FILTER_SANITIZE_STRING);
    if($Process == 'Login'){
        $UserLogin  = new User();
        $UserLogin->Login($Username,$Password);
        if($UserLogin->login($Username,$Password)){
            $_SESSION['Username'] = $Username;
            //header('Location: loggedin.php');
            //exit;
            echo 'loggedin.php';
        } else {
            echo 'index.php';
        }
    }
    if($Process == 'Logout'){
        $UserLogout = new User();
        $UserLogout->Logout();
        if($UserLogout == true){
            echo 'index.php';
        }
    }
    if($Process == 'addPost') {
        $UserId = filter_input(INPUT_POST,'UserId',FILTER_SANITIZE_NUMBER_INT);
        $NewPost= filter_input(INPUT_POST,'NewPost',FILTER_SANITIZE_STRING);
        $PostObject = new User($UserId,$NewPost);
        $PostObject->addPost();
    }
    if ($Process == 'showPosts') {
        $PostArray          = PostManagement::showPosts();
        $PostArrayToReturn  = array();
        if(!empty($PostArray)) {
            foreach ($PostArray AS $Post) {
                array_push($PostArrayToReturn,$Post->getArray());
                $Post->getJson();
            }
        }
        echo json_encode($PostArrayToReturn);
    }
    if ($Process == 'loadUser') {
        $Id = filter_input(INPUT_POST,'Id',FILTER_SANITIZE_NUMBER_INT);
        $PersonObject = PostManagement::loadUser($Id);
        echo $PersonObject->getJson();
    }
    if ($Process == 'UpdateUser'){
        $Id = filter_input(INPUT_POST,'Id',FILTER_SANITIZE_NUMBER_INT);
        $UserObject = new User($Id,'','','','','',$FirstName,$LastName,$EmailAddress,$Username,$Password);
        $UserObject -> updateUser();
    }
}
