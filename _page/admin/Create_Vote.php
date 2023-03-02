<?php 
session_start();
include('./../../_system/database.php');

$db = new database();
$currentpage = basename(__FILE__);
$db -> secureCheck();
$db -> checkAdmin();
$userid = $_SESSION['userid'];


if(isset($_POST['create'])){
    $name = $_POST['name'];

    $data = [
        'text_vh' => $name
    ];

    $db -> insert("vote_header",$data);

    if($db -> query){
        $_SESSION['success'] = "Header Successfully Added";
        header("location:".$_SERVER['REQUEST_URI']);
        return;
    }else{
        $_SESSION['error'] = "Header Error Added";
        header("location:".$_SERVER['REQUEST_URI']);
        return;
    }
}

if(isset($_POST['create_option'])){
    $text_option = $_POST['text_option'];
    $id_vh = $_POST['id_vh'];
    $file = $_FILES['file'];

    $filedb = new database();
    $fileNew = $filedb -> uploadFile($file);

    $data = [
        'text_vo' => $text_option,
        'vh_vo' => $id_vh,
        'file_vo' => $fileNew
    ];

    $db -> insert("vote_option",$data);

    if($db -> query){
        $_SESSION['success'] = "Option Successfully Added";
        header("location:".$_SERVER['REQUEST_URI']);
        return;
    }else{
        $_SESSION['error'] = "Option Error Added";
        header("location:".$_SERVER['REQUEST_URI']);
        return;
    }
}

if(isset($_POST['edit'])){
    $name = $_POST['name']; 
    $id_vh = $_POST['id_vh'];

    $data = [
        'text_vh' => $name
    ];

    $db -> update("vote_header",$data," id_vh = $id_vh");
    if($db -> query){
        $_SESSION['success'] = "Header Successfully Edited";
        header("location:".$_SERVER['REQUEST_URI']);
        return;
    }else{
        $_SESSION['error'] = "Header Error Edited";
        header("location:".$_SERVER['REQUEST_URI']);
        return;
    }
}

if(isset($_POST['delete'])){
    $id_vh = $_POST['id_vh'];

    $db -> delete("vote_header"," id_vh = $id_vh");
    if($db -> query){
        $_SESSION['success'] = "Header Successfully Deleted";
        header("location:".$_SERVER['REQUEST_URI']);
        return;
    }else{
        $_SESSION['error'] = "Header Error Deleted";
        header("location:".$_SERVER['REQUEST_URI']);
        return;
    }
}

if(isset($_POST['disabled'])){
    $id_vh = $_POST['id_vh'];

    $db -> update("vote_header",['status_vh' => 0],"id_vh = $id_vh");
    if($db -> query){
        $_SESSION['success'] = "Header Disabled Successfully";
        header("location:".$_SERVER['REQUEST_URI']);
        return;
    }else{
        $_SESSION['error'] = "Food Disabled Error ";
        header("location:".$_SERVER['REQUEST_URI']);
        return;
    }
}

if(isset($_POST['active'])){
    $id_vh = $_POST['id_vh'];

    $db -> update("vote_header",['status_vh' => 1],"id_vh = $id_vh");
    if($db -> query){
        $_SESSION['success'] = "Header Activated Successfully";
        header("location:".$_SERVER['REQUEST_URI']);
        return;
    }else{
        $_SESSION['error'] = "Header Activated Error ";
        header("location:".$_SERVER['REQUEST_URI']);
        return;
    }
}


if(isset($_GET['delete_vo'])){
    $id_vo = $_GET['id_vo'];

    $db -> delete("vote_option"," id_vo = $id_vo");
    if($db -> query){
        $_SESSION['success'] = "Option Successfully Deleted";
        header("location:./Create_Vote.php");
        return;
    }else{
        $_SESSION['error'] = "Option Error Deleted";
        header("location:./Create_Vote.php");
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
    <title>Admin Page</title>
    <link rel="stylesheet" href="./../../style/css/admin_hp.css">
    <script defer src="./../../style/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./../../style/css/bootstrap.css">


</head>

<body>
    <!--Main Navigation-->
    <header>
        <?php include('./../components/sidebar.php');?>
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="row">
                <h3> Vote Header All</h3>
                <?php include('./../components/error.php'); ?>
                <?php include('./../components/modal_create_vote.php');?>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Header</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $db_2 = new database();
                        $db_2 -> select("vote_header","*");
                        while($fetch_header = $db_2 -> query -> fetch_object())
                        {
                            ?>
                        <tr>
                            <td><?= $fetch_header -> id_vh ?></td>
                            <td><?= $fetch_header -> text_vh ?></td>
                            <td><?php include('./../components/modal_edit_header.php'); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
    </main>
    <!--Main layout-->
</body>


</html>