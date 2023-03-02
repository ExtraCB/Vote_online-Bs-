<?php 
session_start();
include('./../../_system/database.php');
$db = new database();


if(isset($_POST['register'])){
    $usrname = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $file = $_FILES['file'];

    $fileNew = $db -> uploadFile($file);

    $data = [
        'username_user' => $usrname,
        'password_user' => $password,
        'fname_user' => $fname,
        'lname_user' => $lname,
        'address_user' => $address,
        'tel_user' => $tel,
        'file_user' => $fileNew
    ];

    $db -> insertWhere("users",$data," (SELECT username_user FROM users WHERE username_user = '$usrname')");

    if($db -> mysqli -> affected_rows > 0){
        $_SESSION['alert'] = "Register Successfully"; 
        header('location:'.$_SERVER['REQUEST_URI']);
        return;
    }else{
        $_SESSION['alert'] = "Username already to use !"; 
        header('location:'.$_SERVER['REQUEST_URI']);
        return;
    }
}

if(isset($_POST['login'])){
    $db = new database();


    $username = $_POST['username_login'];
    $password = $_POST['password_login'];

    $db -> select("users,types","*"," username_user = '$username' AND password_user = '$password' AND type_user = id_type");
    if($db -> query -> num_rows > 0){
        $fetch = $db -> query -> fetch_object();
        $_SESSION['userid'] = $fetch -> id_user;
        $_SESSION['type'] = $fetch -> name_type;

        if($fetch -> status_user == 0){
            $_SESSION['alert'] = "Please wait active from administrator"; 
            header('location:'.$_SERVER['REQUEST_URI']);
            return;
        }else{
            if($_SESSION['type'] == 'user' && $fetch -> dept_user == ""){
                header('location:./../'.$_SESSION['type'].'/Homepage.php?table=1');
                return;
            }else{
                header('location:./../'.$_SESSION['type'].'/Homepage.php');
                return;
            }
        }
        
    }else{
        $_SESSION['alert'] = "Username or password incorrect !";
        header('location:'.$_SERVER['REQUEST_URI']);
        return;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" href="./../../style/icon/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./../../style/css/login.css">
    <link rel="stylesheet" href="./../../style/css/alert_css.css">


</head>
   
<body>
    <h2 style="color:black">Vote System</h2>
    <?php  include('./../components/error_alert.php'); ?>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Create Account</h1>
                <input type="text" name="username" placeholder="Username" required />
                <input type="text" name="fname" placeholder="Firstname" required />
                <input type="text" name="lname" placeholder="Lastname" required />
                <input type="text" name="tel" placeholder="Tel" required />
                <input type="text" name="address" placeholder="Address" required />
                <input type="file" name="file" id="">
                <input type="password" placeholder="Password" name="password" required />
                <button type="submit" name="register">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="" method="post">
                <h1>Sign in</h1>
                <input type="text" name="username_login" required placeholder="Username" />
                <input type="password" name="password_login" required placeholder="Password" />
                <button type="submit" name="login">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam culpa praesentium fugiat labore
                        omnis eum molestiae porro nobis nesciunt dolorem?</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello !</h1>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque, minus.</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
    </script>
</body>


</html>