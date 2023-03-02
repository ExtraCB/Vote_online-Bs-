<?php 
session_start();
include('./../../_system/database.php');

$db = new database();
$currentpage = basename(__FILE__);
$db -> secureCheck();
$userid = $_SESSION['userid'];



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <script defer src="./../../style/js/bootstrap.bundle.js"></script>
    <script src="./../../style/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./../../style/css/bootstrap.css">


</head>

<body>
    <!--Main Navigation-->
    <header>
        <?php  include('./../components/navbar_user.php'); ?>
    </header>
    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="row">
                <?php  include('./../components/error.php'); ?>

            </div>
            <div class="row ">
                <table class="table">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th>หัวข้อ</th>
                            <th>ผู้สมัครที่เลือก</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                $db -> select("vote_status,vote_option,vote_header","status_vh,id_vh,text_vh,file_vo,text_vo","own_vs = $userid AND vo_vs = id_vo AND vh_vo = id_vh");
                while($fetch_header = $db -> query -> fetch_object()){
                ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $fetch_header -> text_vh ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="./../../file/<?= $fetch_header -> file_vo ?>" alt=""
                                        style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1"><?= $fetch_header -> text_vo ?></p>
                                    </div>
                                </div>
                            </td>
                            <td><?php include('./../components/modal_vote.php') ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>


</html>