<?php
include("config.php");
include("firebaseRDB.php");

$username = $_POST['username'];
$password = $_POST['password'];

if($username == ""){
    echo "Username is required";
} else if ($password == ""){
    echo "Password is required";
}else{
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/user", "username", "EQUAL", $username);
    $data = json_decode($retrieve, 1);

    if(count($data) == 0){
        header("location: admin_incorrect.html");
    }else{
        $id = array_keys($data)[0];
        if($data[$id]['password'] == $password){
            $_SESSION['user'] = $data[$id];
            header("location: admin_home.html");
    }else{
        header("location: admin_incorrect.html");
    }
}
}
