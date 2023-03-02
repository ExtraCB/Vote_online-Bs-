<div class="">
    <a href="" class="btn btn-default btn-rounded mb-4" data-bs-toggle="modal" data-bs-target="#createPoll">Create</a>
</div>
<form action="" method="post">
    <div class="modal fade" id="createPoll" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Create Vote</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>


                <div class="modal-body mx-3">
                    <div class="md-form ">
                        <input type="text" id="defaultForm-email" name="name" class="form-control validate">
                        <label data-error="wrong" data-success="right" for="defaultForm-email">Header Vote</label>
                    </div>
                </div>
                <div class="modal-footer px-4 d-flex justify-content-between">
                    <button class="btn btn-warning" name="create">Create</button>
                </div>


            </div>
        </div>
    </div>
</form>