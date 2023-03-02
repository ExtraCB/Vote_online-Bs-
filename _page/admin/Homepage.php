<?php 
session_start();
include('./../../_system/database.php');

$db = new database();
$currentpage = basename(__FILE__);
$db -> secureCheck();
$db -> checkAdmin();
$userid = $_SESSION['userid'];

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
            <h3>ผลการเลือกตั้งทั้งหมด</h3>
            <div class="row">
                <?php
                $db_header = new database();
                $db_header -> select("vote_header","*");

                while($fetch_header = $db_header -> query -> fetch_object()){
                    $id_vh = $fetch_header -> id_vh;
                    $sumvote = new database();
                    $sumvote -> select("vote_header,vote_option,vote_status","COUNT(id_vs) as count,id_vs,vo_vs","id_vh = $id_vh AND id_vh = vh_vo AND id_vo = vo_vs");
                    $fetchsum_vote = $sumvote -> query -> fetch_assoc();
                ?>
                <div class="card my-3">
                    <h5 class="card-header"><?= $fetch_header -> text_vh ?></h5>
                    <div class="card-body">
                        <?php 
                        $db_option = new database();
                        $db_option -> selectjoin("vote_option","text_vo,COUNT(vote_status.vo_vs) as sum","LEFT JOIN vote_status","vote_option.vh_vo = $id_vh","vote_option.id_vo = vote_status.vo_vs","vote_option.id_vo");

                        while($fetch_option = $db_option -> query -> fetch_object()){
                            if($fetch_option -> sum != 0){
                                $percent = number_format($fetch_option -> sum * 100 / $fetchsum_vote['count'],'2');
                            }else{
                                $percent = 0;
                            }

                        ?>
                        <b><?= $fetch_option -> text_vo ?></b>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: <?= $percent ?>%;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="<?= $fetchsum_vote['count'] ?>">
                                <?= $percent ?>%
                            </div>
                        </div>
                        <?php }  ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </main>
    <!--Main layout-->
</body>


</html>