<div class="">
    <?php 
    if($fetch_header -> status_vh == 0){ ?>
    <a href="" class="btn btn-secondary btn-disabled btn-rounded mb-4" 
        disabled>รายละเอียด</a>
    <?php } else { ?>
    <a href="" class="btn btn-primary btn-rounded mb-4" data-bs-toggle="modal"
        data-bs-target="#vote<?= $fetch_header -> id_vh ?>">รายละเอียด</a>
    <?php }
    ?>

</div>
<form action="" method="post">
    <div class="modal fade" id="vote<?= $fetch_header -> id_vh ?>" data-bs-keyboard="false" data-bs-backdrop="static"
        tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">รายละเอียดการเลือกตั้ง</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>


                <div class="modal-body mx-3">
                    <?php 
                            $id_vh = $fetch_header -> id_vh;
                            $dbcheck = new database();
                            $dbcheck -> select("vote_header,vote_option,vote_status","COUNT(id_vs) as count,id_vs,vo_vs","id_vh = $id_vh AND id_vh = vh_vo AND id_vo = vo_vs AND own_vs = $userid");
                            $result = $dbcheck -> query;
                            $fetch_check = $result -> fetch_assoc();


                            $db5 = new database();
                            $db5 -> select("vote_option","*","vh_vo = $id_vh");
                            while($fetch_option = $db5 -> query -> fetch_object()) {
                            ?>
                    <div class="form-check">
                        <img src="./../../file/<?= $fetch_option -> file_vo ?>" alt=""
                            style="width:125px;height:100px;">
                        <input class="form-check-input" type="radio" name="value" value="<?= $fetch_option -> id_vo; ?>"
                            id="flexRadioDefault1"
                            <?= ($fetch_check['vo_vs'] == $fetch_option -> id_vo ? "checked" : "") ?>>
                        <label class="form-check-label" for="flexRadioDefault1">
                            <?= $fetch_option -> text_vo ?>
                        </label>
                    </div>
                    <?php } ?>
                </div>
                <div class="modal-footer px-4 d-flex justify-content-between">
                    <?php 
                if($fetch_check['count'] != 0){ ?>
                    <input type="hidden" name="id_vs" value="<?= $fetch_check['id_vs'] ?>">
                    <button class="btn btn-warning" name="edit">แก้ไข</button>
                    <?php }else{ ?>
                    <button class="btn btn-warning" name="selected">เลือก</button>
                    <?php }
                ?>

                </div>


            </div>
        </div>
    </div>
</form>