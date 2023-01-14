<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Add auto reply</h4>
            <button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        
        <div class="modal-body">
            <form id="form-text-auto-reply-save" class="form-horizontal" role="form" data-parsley-validate novalidate>
                <!-- <div class="form-group row">
                    <div class="col-sm-8">
                        <input type="text" name="id" required parsley-type="text" value="<?= !empty($id) ? $id : $id ?>" class="form-control"
                                id="inputBotID" placeholder="Type" readonly>
                    </div>
                </div> -->
                
                <!-- <div class="form-group row">
                    <label for="inputBotID" class="col-sm-4 col-form-label">Bot ID</label>
                    <div class="col-sm-8">
                        <input type="text" name="bot_id" required parsley-type="text" value="<?= $bot_id ?>" class="form-control"
                                id="inputBotID" placeholder="Type" readonly>
                    </div>
                </div> -->

                <div class="form-group row">
                    <div class="col-sm-8">
                        <input type="hidden" name="id" required parsley-type="text" value="<?= !empty($text_auto_reply["Id"]) ? $text_auto_reply["Id"] : 0 ?>" class="form-control"
                                id="inputBotID" placeholder="Type" readonly>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="inputBotID" class="col-sm-4 col-form-label">Bot ID</label>
                    <div class="col-sm-8">
                        <input type="text" name="bot_id" required parsley-type="text" value="<?= $bot_id ?>" class="form-control"
                                id="inputBotID" placeholder="Type" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputKeywordTrigger" class="col-sm-4 col-form-label">Keyword trigger* </label>
                    <div class="col-sm-8">
                        <input type="text" name="keyword_trigger" required parsley-type="text" class="form-control" value="<?= !empty($text_auto_reply["IncomingMsg"]) ? $text_auto_reply["IncomingMsg"] : "" ?>"
                                id="inputKeywordTrigger" placeholder="Trigger keyword">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputCaseSensitive" class="col-sm-4 col-form-label">Case sensitive</label>
                    <div class="col-sm-8">
                        <?php
                            $checked = "";
                            if ( !empty($text_auto_reply) ) {
                                if ( $text_auto_reply["IsCaseSensitive"] == 1 ) $checked = "checked";
                            }
                        ?>
                        <div class="checkbox">
                            <input id="inputCaseSensitive" name="case_sensitive" type="checkbox" <?= $checked ?>>
                            <label for="inputCaseSensitive"> </label>
                        </div>
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="inputUpload" class="col-sm-4 col-form-label">
                        Attachment <br>
                        [PDF/PNG/JPG/JPEG]
                    </label>

                    <div class="col-sm-8">
                       <input id="inputUpload" name="attachment" type="file">
                    </div>
                </div> -->

                <div class="form-group row">
                    <label for="inputPattern" class="col-sm-4 col-form-label">Pattern* </label>
                    <div class="col-sm-8">
                        <select class="form-control pattern-select2" name="pattern">
                            <option>Select</option>
                            <?php foreach ( $patterns as $index => $pattern ):  ?>
                                <?php
                                    $selected   = "";
                                    if ( !empty($text_auto_reply["PaternID"]) ) {
                                        if ( $text_auto_reply["PaternID"] == $index ) $selected = "selected";
                                    }  
                                ?>
                                <option value=<?= $index ?> <?= $selected ?>><?= $pattern ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputReplyText" class="col-sm-4 col-form-label">Reply text* </label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="" name="reply_text" id=""><?= !empty($text_auto_reply["ReturnMsg"]) ? $text_auto_reply["ReturnMsg"] : "" ?></textarea>
                    </div>
                </div>
                
                <div class="text-right">
                    <button type="button" class="btn btn-sm btn-light waves-effect" data-dismiss="modal">Close</button>
                    <?php if ( !empty($text_auto_reply["Id"]) ): ?>
                        <button type="submit" class="btn tbn-sm btn-light waves-effect waves-light text-success" id="btn-text-auto-reply-update">Update</button>
                    <?php else: ?>
                        <button type="submit" class="btn tbn-sm btn-light waves-effect waves-light text-success" id="btn-text-auto-reply-save">Save</button>
                    <?php endif ?>
                </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->