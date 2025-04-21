<?php
include("config.php");
include("firebaseRDB.php");

$name = $_POST['name'];
$username= $_POST['username'];
$password = $_POST['password'];

if($name == ""){
    echo "Name is required";
}else if ($username == ""){
        echo "Username is required";
}else if ($password == ""){
    echo "Password is required";
}else{
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/user", "username", "EQUAL", $username);
    $data = json_decode($retrieve, 1);

    if(isset($data['username'])){
        header("location: Signup_r.html");
        exit();
    }else{
        $insert = $rdb->insert("/user", [
            "name" => $name,
            "username" => $username,
            "password" => $password
        ]);

        $result = json_decode($insert, 1);
        if(isset($result['name'])){
            header("location: Signup_s.html");
        }else{
            header("location: Signup_f.html");
        }
    }
}
