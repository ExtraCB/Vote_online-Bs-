<div class="">
    <a href="" class="btn btn-default btn-rounded mb-4" data-bs-toggle="modal"
        data-bs-target="#editHeader<?= $fetch_header -> id_vh ?>">Edit</a>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="editHeader<?= $fetch_header -> id_vh ?>" data-bs-keyboard="false"
        data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Edit Vote</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="row">
                        <div class="md-form ">
                            <input type="text" id="defaultForm-email" name="name" class="form-control validate"
                                value="<?= $fetch_header -> text_vh ?>">
                            <label data-error="wrong" data-success="right" for="defaultForm-email">Header Vote</label>
                            <input type="hidden" name="id_vh" value="<?= $fetch_header -> id_vh ?>">
                        </div>
                        <div class="md-form mt-2">
                            <button class="btn btn-primary" name="edit">Edit</button>
                            <button class="btn btn-danger" name="delete">Delete</button>
                            <?php if($fetch_header -> status_vh == 0) { ?>
                            <button class="btn btn-success" name="active">Active</button>
                            <?php }else { ?>
                            <button class="btn btn-warning" name="disabled">Disabled</button>
                            <?php } ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <h4>Create Option</h4>
                        <div class="md-form mt-2">
                            <input type="text" id="defaultForm-email" name="text_option" class="form-control validate">
                            <label data-error="wrong" data-success="right" for="defaultForm-email">Option Vote</label>
                        </div>
                        <div class="md-form mt-2">
                            <input type="file" id="defaultForm-email" name="file" class="form-control validate">
                            <label data-error="wrong" data-success="right" for="defaultForm-email">Image Vote</label>
                        </div>
                        <div class="md-form mt-2">
                            <button class="btn btn-warning" name="create_option">Create Option</button>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>รูปภาพ</th>
                                        <th>ข้อความ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                            $id_vh = $fetch_header -> id_vh;
                            $db5 = new database();
                            $db5 -> select("vote_option","*","vh_vo = $id_vh");
                            while($fetch_option = $db5 -> query -> fetch_object()) {
                            ?>
                                    <tr>
                                        <td><?= $fetch_option -> id_vo ?></td>
                                        <td><img src="./../../file/<?= $fetch_option -> file_vo ?>" alt=""
                                                style="width:150px;height:150px"></td>
                                        <td><?= $fetch_option -> text_vo ?></td>
                                        <td>
                                            <a href="./Create_Vote.php?id_vo=<?= $fetch_option -> id_vo?>&delete_vo=1"
                                                class="btn btn-danger">ลบ</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer px-4 d-flex justify-content-between">

                </div>
            </div>
        </div>
    </div>
</form>