<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_allergy_fact'); ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('system_settings/edit_allergy_fact/' . $allergy_facts->id, $attrib); ?>
        <div class="modal-body">
            <p><?= lang('update_info'); ?></p>


            <div class="form-group">
                <?= lang('name', 'name'); ?>
                <?= form_input('name', $allergy_facts->name, 'class="form-control gen_slug" id="name" required="required"'); ?>
            </div>

            <?php echo form_hidden('id', $allergy_facts->id); ?>
        </div>
        <div class="modal-footer">
            <?php echo form_submit('edit_allergy_fact', lang('edit_allergy_fact'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?= $modal_js ?>
