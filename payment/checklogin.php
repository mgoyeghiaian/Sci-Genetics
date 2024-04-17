<?php
if(isset($_POST['login'])){
    include('service.php');
    $service=new Service();

    $checklogin = $service->login($_POST['username'],$_POST['password']);
    if(!empty($checklogin)){
        session_start();
        $_SESSION['id'] = $checklogin[0];
        header("Location:index.php");
    }else{
        header("Location:login.php");
    }
}