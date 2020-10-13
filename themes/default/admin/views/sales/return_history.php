<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
    function sale_status(x) {
        if (x == null) {
            return '';
        } else {
            return '<div class="text-center"><span class="row_status label label-info">' + x + '</span></div>';
        }
    }
    $(document).ready(function () {
        oTable = $('#SLData').dataTable({
            "aaSorting": [[0, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?=lang('all')?>"]],
            "iDisplayLength": <?=$Settings->rows_per_page?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?=admin_url('sales/getReturnHistory' . ($warehouse_id ? '/' . $warehouse_id : '') . '?v=1' . ($this->input->get('shop') ? '&shop=' . $this->input->get('shop') : '') . ($this->input->get('attachment') ? '&attachment=' . $this->input->get('attachment') : '') . ($this->input->get('delivery') ? '&delivery=' . $this->input->get('delivery') : '')); ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?=$this->security->get_csrf_token_name()?>",
                    "value": "<?=$this->security->get_csrf_hash()?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable.fnSettings();
                //$("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                nRow.id = aData[0];
                nRow.setAttribute('data-return-id', aData[11]);
                nRow.className = "invoice_link re"+aData[11];
                return nRow;
            },
            "aoColumns": [{"bSortable": false,"mRender": checkbox}, {"mRender": fld}, null, null, null,  null, null, null,null, {"mRender": sale_status},{"mRender": pay_status}],
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var gtotal = 0;
                for (var i = 0; i < aaData.length; i++) {
                    gtotal += parseFloat(aaData[aiDisplay[i]][7]);
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[7].innerHTML = currencyFormat(parseFloat(gtotal));
            }
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('reference_no');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('biller');?>]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[<?=lang('customer');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('code');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('name');?>]", filter_type: "text", data: []},
            //{column_number: 10, filter_default_label: "[<?//=lang('sale_status');?>//]", filter_type: "text", data: []},
        ], "footer");

    });

</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                    class="fa-fw fa fa-random"></i><?=lang('Return_History')?>
        </h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?=lang('actions')?>"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?=lang('list_results');?></p>

                <div class="table-responsive">
                    <table id="SLData" class="table table-bordered table-hover table-striped" cellpadding="0" cellspacing="0" border="0">
                        <thead>
                        <tr>
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th><?= lang('date'); ?></th>
                            <th><?= lang('reference_no'); ?></th>
                            <th><?= lang('biller'); ?></th>
                            <th><?= lang('customer'); ?></th>
                            <th><?= lang('product_code'); ?></th>
                            <th><?= lang('product_name'); ?></th>
                            <th><?= lang('quantity'); ?></th>
                            <th><?= lang('UM'); ?></th>
                            <th><?= lang('warehouse'); ?></th>
                            <th><?= lang('sale_status'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="12" class="dataTables_empty"><?= lang('loading_data'); ?></td>
                        </tr>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th></th><th></th><th></th><th></th>
                            <th></th>
                            <th></th>
                            <th><?= lang('quantity'); ?></th>
                            <th><?= lang('um'); ?></th>
                            <th><?= lang('warehouse'); ?></th>
                            <th><?= lang('sale_status'); ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>