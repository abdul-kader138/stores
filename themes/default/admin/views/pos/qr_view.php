<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if ($modal) {
?>
<div class="modal-dialog no-modal-header" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <?php
            } else {
            ?><!doctype html>
            <html>
            <head>
                <meta charset="utf-8">
                <title><?= $page_title . ' ' . lang('no') . ' ' . $inv->id; ?></title>
                <base href="<?= base_url() ?>"/>
                <meta http-equiv="cache-control" content="max-age=0"/>
                <meta http-equiv="cache-control" content="no-cache"/>
                <meta http-equiv="expires" content="0"/>
                <meta http-equiv="pragma" content="no-cache"/>
                <link rel="shortcut icon" href="<?= $assets ?>images/icon.png"/>
                <link rel="stylesheet" href="<?= $assets ?>styles/theme.css" type="text/css"/>
                <link href="<?= base_url('assets/custom/pos.css') ?>" rel="stylesheet"/>
                <style type="text/css" media="all">
                    body {
                        color: #000;
                    }

                    #wrapper {
                        max-width: 480px;
                        margin: 0 auto;
                        padding-top: 20px;
                    }

                    .btn {
                        border-radius: 0;
                        margin-bottom: 5px;
                    }

                    .bootbox .modal-footer {
                        border-top: 0;
                        text-align: center;
                    }

                    h3 {
                        margin: 5px 0;
                    }

                    .order_barcodes img {
                        float: none !important;
                        margin-top: 5px;
                    }

                    @media print {
                        .no-print {
                            display: none;
                        }

                        #wrapper {
                            max-width: 480px;
                            width: 100%;
                            min-width: 250px;
                            margin: 0 auto;
                        }

                        .no-border {
                            border: none !important;
                        }

                        .border-bottom {
                            border-bottom: 1px solid #ddd !important;
                        }

                        table tfoot {
                            display: table-row-group;
                        }
                    }
                </style>
            </head>

            <body>
            <?php
            } ?>
            <div id="wrapper">
                <div id="receiptData">
                    <div class="no-print">
                        <?php
                        if ($message) {
                            ?>
                            <div class="alert alert-success">
                                <button data-dismiss="alert" class="close" type="button">×</button>
                                <?= is_array($message) ? print_r($message, true) : $message; ?>
                            </div>
                            <?php
                        } ?>
                    </div>
                    <div id="receipt-data">
                        <?php
                        echo '<p>' . lang('date') . ': ' . $this->sma->hrld($inv->date) . '<br>';
                        echo lang('sale_no_ref') . ': ' . $inv->reference_no . '<br>';
                        echo lang('sales_person') . ': ' . $created_by->first_name . ' ' . $created_by->last_name . '</p>';
                        echo '<p>';
                        echo lang('customer') . ': ' . ($customer->company && $customer->company != '-' ? $customer->company : $customer->name) . '<br>';
                        echo '</p>';
                        ?>

                        <div style="clear:both;"></div>
                        <table class="table table-condensed">
                            <tbody>
                            <?php
                            foreach ($rows as $row) {
                                $qr_obj = '';
                                $qr_obj = nl2br(lang('product_name') . ': ' . $row->product_name);
                                if (!empty($row->cf1)) $qr_obj .= nl2br(lang('recipe_one') . ':' . "\r\n" . $row->cf1 . "\r\n");
                                if (!empty($row->cf2)) $qr_obj .= nl2br(lang('recipe_two') . ':' . "\r\n" . $row->cf2 . "\n");
                                if (!empty($row->cf3)) $qr_obj .= nl2br(lang('origin') . ': ' . $row->cf3 . "\n");
                                if (!empty($row->cf5)) $qr_obj .= nl2br(lang('nutrition_facts') . ': ' . $row->cf5 . "\n");
                                ?>
                                <hr>
                                <div class="order_barcodes text-center">
                                    <?= $this->sma->qrcode('text', $qr_obj, 4); ?>
                                </div>
                                <br>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
                    <hr>
                        <span class="pull-right col-xs-12">
                    <button onclick="window.print();" class="btn btn-block btn-primary"><?= lang('print'); ?></button>
                       </span>
                        <span class="col-xs-12">
                    <a class="btn btn-block btn-success" href="<?= admin_url('pos'); ?>"><?= lang('back_to_pos'); ?></a>
                         </span>
                    <span class="col-xs-12">
                    <a class="btn btn-block btn-success" href="<?= admin_url('sales'); ?>"><?= lang('sales'); ?></a>
                         </span>
                </div>
            </div>

            <?php
            if (!$modal) {
                ?>
                <script type="text/javascript" src="<?= $assets ?>js/jquery-2.0.3.min.js"></script>
                <script type="text/javascript" src="<?= $assets ?>js/bootstrap.min.js"></script>
                <script type="text/javascript" src="<?= $assets ?>js/jquery.dataTables.min.js"></script>
                <script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
                <?php
            }
            ?>

            </body>
            </html>
