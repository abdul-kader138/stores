<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('add_allergy_fact'); ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('system_settings/add_allergy_fact', $attrib); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>

            <div class="form-group">
                <?= lang('name', 'name'); ?>
                <?= form_input('name', '', 'class="form-control gen_slug" id="name" required="required"'); ?>
            </div>
        </div>
        <div class="modal-footer">
            <?php echo form_submit('add_allergy_fact', lang('add_allergy_fact'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?= $modal_js ?>
