<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?= $modal_heading ?></h4>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

    <div class="modal-body">
        <div id="message_response"></div>

        <form id="form-send-invitation-member" class="form-horizontal" role="form" data-parsley-validate novalidate>
            <?php if ( empty($details) ): ?>
                <div class="form-group row">
                    <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" required parsley-type="text" class="form-control"
                                id="inputName" name="name" placeholder="Enter name">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" required parsley-type="text" class="form-control"
                                id="inputEmail" name="email" placeholder="Enter email">
                    </div>
                </div>
            <?php else: ?>
                <input type="hidden" required parsley-type="text" class="form-control" value="<?= $details["member_number"] ?>"
                                id="inputEmail" name="member_number" placeholder="Enter email">

                <div class="form-group row">
                    <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <h4><?= $details["full_name"] ?></h4>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                       <h4><?= $details["email_address"] ?></h4>
                    </div>
                </div>
            <?php endif ?>

            <div class="form-group row">
                <label for="inputEmail" class="col-sm-3 col-form-label">Access</label>
                <div class="col-sm-9">
                    <select class="form-control role-list-select2" name="access">
                        <?php foreach ($role_list as $id => $role): ?>
                            <?php
                                $selected   = "";
                                if ( !empty($details) ) {
                                    if ( $details["membership"][0]["application_role_name"] == $role ) $selected = "selected";
                                }  
                            ?>
                            <option value="<?= $id ?>" <?= $selected ?>><?= $role ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="mt-4 text-right">
                <button type="button" class="btn btn-sm btn-light waves-effect" data-dismiss="modal">Close</button>
                <?php if ( empty($details) ): ?>
                    <button type="submit" class="btn tbn-sm btn-light waves-effect waves-light text-success" id="btn-send-invitation-member">Send</button>
                <?php else: ?>
                    <button type="submit" class="btn tbn-sm btn-light waves-effect waves-light text-success" id="btn-save-member">Save</button>
                <?php endif ?>
            </div>
        </form>
    </div>
</div>
