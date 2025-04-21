<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Form</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_log.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body style="background-color: #F2EFE7; align-items:center;  background-position: center center;
     background-attachment: fixed; background-size: 100%;">
</body>
<body>
    <div style="background-color:rgb(41, 114, 178); width:400px;height:800px; position: absolute;border-radius: 0px;
    margin-top:-10px; margin-left:-10px;"
    class="container">
    <img style="float: left; width:210px;height:200px; margin-bottom: 150px; color:;
    position: fixed;opacity: 80%;"src="../admin/IMG/trans.png" alt="Description of the image">
    <h2 style ="color:black; float: left; position: fixed; font-size: 25px; margin-top: 30px;
    font-family:Merriweather; opacity: 80%;color: #F2EFE7;">STENO INTERPRETER</h2>
    <h3 style ="color:black; float: left; position: fixed; font-size: 25px; margin-top: 100px;
    font-family:Merriweather; opacity: 80%;color: #F2EFE7;">ADMIN</h3>
</div>
</body>
<body>
<?php


require_once "../admin/vendor/autoload.php";


$clientID = '114075797122-lhapiufp0urp2s3do5fn2mugs7fga4np.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/loads/admin/admin_log.php';


$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../css/admin3B.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+128+Text&family=Tiny5&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jacquard+12&display=swap" rel="stylesheet">
</head>
<body style="background-color: #F2EFE7; align-items:center;  background-position: center center;
     background-attachment: fixed; background-size: 100%;"></body>
<body>
    <label>
        <input type="checkbox">
        <div style="background-color:#48A6A7;"class="toggle">
            <div class="common"></div>
            <div class="common1"></div>
            <div class="common2"></div>
            <span class="top_line"></span>
            <span class="middle_line"></span>
            <span class="bottom_line"></span>
        </div>
        <div style="background-color:#9ACBD0;" class="slide">
            <h1><i style="background-color:#48A6A7;"class="fa-solid fa-desktop"></i></h1><br><br>
            <ul>
                <li><a href="../admin/admin_home.html"><i class="fa-sharp fa-solid fa-house"></i>Home</a></li><br>
                <li><a href="../admin/admin_manage_user.php"><i class="fa-solid fa-person-chalkboard" action = "approval.php"></i>Manage Users</a></li><br>
                <li><a href="../admin/admin_users.php"><i class="fa-solid fa-user"></i>Users</a></li><br><br><br><br><br>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <li><a href="../admin/admin.html" style="text-align:center;">Log out</a></li>
            </ul>
        </div> 
  </label>
</body>
<body>
<h1 style=" background-color:#2973B2"></h1>
    <div style="background-color: rgba(255, 255, 255, 0); border-radius: 0cap;"class="container">
        <li style="font-size:80px; margin:0 auto; margin-top:180px;">Welcome to Admin</li>
  </div>
  <div style="background-color: rgba(255, 255, 255, 0);" class="container">
    <li style="font-size:80px; margin:0 auto; margin-top:250px;">Page</li>
</div>
<div style="background-color: rgba(128, 41, 41, 0);" class="container">
    <li style="font-size:20px; margin:0 auto; margin-top:460px; color:red;">click the control panel on the top-left corner</li>
</body>
</html>
<?php } else {?>
<div style="background-color:rgba(41, 114, 178, 0.61); margin-left:650px;"class="container">
    <form method = "post" action = "login_action.php">
        <h2>LOGIN FORM</h2>
        Username<br>
        <input type ="text" name = "username" placeholder="Enter Username"required><br><br>
        Password<br>
        <input type="password" name="password" placeholder="Enter Password"required><br><br>
        <input type="submit" style =" width: 370px; padding: 10px; font-size:12px; color: antiquewhite;background-color:rgba(17, 172, 17, 0.87)" value="LOGIN"><br><br>
        <div style ="margin-left: 50px;">Don't have an account yet? <a href = "admin_signup.html">Sign up</a></div><br>
        <center><a href="<?php echo $client->createAuthUrl()?>">
            <img style="margin-right: 40px;" src="../IMG/image.png" width="220"></a></center>
    </form>
</div>
</body>
<?php } ?>
</html>