<?php
/*
 * php code///////////**********************************************************
 */
if(!isset($_GET['id'])){
    header("location:" . $baseUrl . "/back/order");
}
$db = new database();
$sql_od = "SELECT d.*,p.id,p.name,p.image FROM order_details d INNER JOIN products p ";
$sql_od .= "ON d.product_id=p.id ";
$sql_od .="WHERE d.order_id='{$_GET['id']}' ";
$query_od = $db->query($sql_od);
$title = 'รายละเอียดการชำระเงิน';
/*
 * php code///////////**********************************************************
 */

/*
 * header***********************************************************************
 */
require 'template/back/header.php';
/*
 * header***********************************************************************
 */
?>
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/jquery.datetimepicker.css" type="text/css" />

<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery.form-validator.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/ckeditor/ckeditor.js"></script>
<script type='text/javascript' src="<?php echo $baseUrl; ?>/js/jquery.datetimepicker.js"></script>
<div id="page-warpper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">รายละเอียดการชำระเงิน</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="subhead">
                <a role="button" id="save" class="btn btn-success btn-xs new-data" href="#">
                    <i class="glyphicon glyphicon-floppy-save"></i>
                    บันทึก
                </a>
                <a role="button" class="search-button btn btn-default btn-xs" href="<?php echo $baseUrl; ?>/back/order">
                    <i class="glyphicon glyphicon-remove-circle"></i>
                    ยกเลิก
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-horizontal" style="margin-top: 10px;">
                <form id="order-form" action="<?php echo $baseUrl; ?>/back/order/form_payment" method="post">
                    <input type="hidden" name="order_id" value="<?php echo $_GET['id']; ?>">
                    <div class="form-group">
                        <label for="Product_name" class="col-sm-4 control-label required">จำนวนเงิน <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" id="pay_money" name="pay_money" class="form-control input-sm" data-validation="number" data-validation-allowing="float">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="col-sm-4 control-label required">วันที่โอน <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" id="pay_date" name="pay_date" class="form-control input-sm" data-validation="date" data-validation-format="dd/mm/yyyy">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Product_name" class="col-sm-4 control-label required">เวลาโอน <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" id="pay_time" name="pay_time" class="form-control input-sm" data-validation="custom" data-validation-regexp="^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" class="form-control input-sm"></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace('detail');
                                function CKupdate() {
                                    for (instance in CKEDITOR.instances)
                                        CKEDITOR.instances[instance].updateElement();
                                }
                            </script>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <table class="table" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อสินค้า</th>
                        <th style="text-align: right;">ราคา(บาท)</th>
                        <th style="text-align: right;">จำนวน</th>
                        <th style="text-align: right;">รวม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grand_total = 0;
                    while ($rs_od = $db->get($query_od)) {
                        $total_price = $rs_od['price'] * $rs_od['quantity'];
                        $grand_total = $total_price + $grand_total;
                        ?>
                        <tr>
                            <td>
                                <img src="<?php echo base_url(); ?>/upload/product/sm_<?php echo $rs_od['image']; ?>">
                            </td>
                            <td><?php echo $rs_od['name']; ?></td>
                            <td style="text-align: right;"><?php echo number_format($rs_od['price'], 2); ?></td>
                            <td style="text-align: right;"><?php echo $rs_od['quantity']; ?></td>
                            <td style="text-align: right;"><?php echo number_format($total_price, 2); ?></td>
                        </tr>
                    <?php } ?>
                    <tr class="info">
                        <td colspan="5" style="text-align: right;">ราคารวมทั้งหมด <strong><?php echo number_format($grand_total, 2); ?></strong> บาท</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    jQuery('#pay_date').datetimepicker({
        format: 'd/m/Y',
        lang: 'th',
        timepicker: false
    });
    jQuery('#pay_time').datetimepicker({
        format: 'H:i',
        datepicker: false,
        step:1
    });
    $(document).ready(function () {
        $("#save").click(function () {
            $("#order-form").submit();
            return false;
        });
    });
    $.validate();
</script>
<?php
/*
 * footer***********************************************************************
 */
require 'template/back/footer.php';
/*
 * footer***********************************************************************
 */
mysql_close();
